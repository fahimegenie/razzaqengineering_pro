<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

#[Layout('components.layouts.admin-layout')]
#[Title('Cache Management - Admin Panel')]
class ClearCache extends Component
{
    public $isClearing = false;
    public $clearType = '';
    public $lastCleared = null;
    public $results = [];
    public $showConfirmModal = false;
    public $confirmAction = '';
    public $confirmTitle = '';

    // Cache statistics
    public $viewCacheCount = 0;
    public $viewCacheSize = '0 B';
    public $appCacheSize = '0 B';
    public $configCacheExists = false;
    public $routeCacheExists = false;
    public $eventCacheExists = false;
    public $compiledCount = 0;

    public function mount()
    {
        $this->loadCacheStats();
        $this->lastCleared = session('last_cache_cleared');
    }

    public function loadCacheStats()
    {
        // View cache
        $viewPath = storage_path('framework/views');
        if (File::exists($viewPath)) {
            $viewFiles = File::files($viewPath);
            $this->viewCacheCount = count($viewFiles);
            $totalSize = 0;
            foreach ($viewFiles as $file) {
                $totalSize += $file->getSize();
            }
            $this->viewCacheSize = $this->formatBytes($totalSize);
        }

        // Application cache
        $cachePath = storage_path('framework/cache/data');
        if (File::exists($cachePath)) {
            $totalSize = 0;
            $files = File::allFiles($cachePath);
            foreach ($files as $file) {
                $totalSize += $file->getSize();
            }
            $this->appCacheSize = $this->formatBytes($totalSize);
        }

        // Config cache
        $this->configCacheExists = File::exists(base_path('bootstrap/cache/config.php'));

        // Route cache
        $this->routeCacheExists = File::exists(base_path('bootstrap/cache/routes-v7.php'));

        // Event cache
        $this->eventCacheExists = File::exists(base_path('bootstrap/cache/events.php'));

        // Compiled classes
        $compiledPath = storage_path('framework/views');
        if (File::exists($compiledPath)) {
            $this->compiledCount = count(File::files($compiledPath));
        }
    }

    private function formatBytes($bytes, $precision = 2): string
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        return round($bytes / pow(1024, $pow), $precision) . ' ' . $units[$pow];
    }

    public function confirmClear($type)
    {
        $titles = [
            'all' => 'Clear All Cache',
            'views' => 'Clear View Cache',
            'app' => 'Clear Application Cache',
            'config' => 'Clear Config Cache',
            'route' => 'Clear Route Cache',
            'event' => 'Clear Event Cache',
            'compiled' => 'Clear Compiled Classes',
            'optimize' => 'Re-optimize Application',
            'livewire' => 'Clear Livewire Cache',
            'debugbar' => 'Clear Debugbar Storage',
            'log' => 'Clear Log Files',
            'temp' => 'Clear Temporary Files',
        ];

        $this->confirmAction = $type;
        $this->confirmTitle = $titles[$type] ?? 'Clear Cache';
        $this->showConfirmModal = true;
    }

    public function executeClear()
    {
        if (!$this->confirmAction) return;

        $this->showConfirmModal = false;
        $this->isClearing = true;
        $this->clearType = $this->confirmAction;
        $this->results = [];

        try {
            switch ($this->confirmAction) {
                case 'all':
                    $this->clearAll();
                    break;
                case 'views':
                    $this->clearViews();
                    break;
                case 'app':
                    $this->clearAppCache();
                    break;
                case 'config':
                    $this->clearConfig();
                    break;
                case 'route':
                    $this->clearRoute();
                    break;
                case 'event':
                    $this->clearEvent();
                    break;
                case 'compiled':
                    $this->clearCompiled();
                    break;
                case 'optimize':
                    $this->optimize();
                    break;
                case 'livewire':
                    $this->clearLivewire();
                    break;
                case 'debugbar':
                    $this->clearDebugbar();
                    break;
                case 'log':
                    $this->clearLogs();
                    break;
                case 'temp':
                    $this->clearTemp();
                    break;
            }

            session(['last_cache_cleared' => now()->format('Y-m-d H:i:s')]);
            $this->lastCleared = session('last_cache_cleared');
            $this->loadCacheStats();
            $this->dispatch('toast', type: 'success', message: 'Cache cleared successfully!');

        } catch (\Exception $e) {
            Log::error('Cache clear error: ' . $e->getMessage());
            $this->results[] = ['type' => 'error', 'message' => 'Error: ' . $e->getMessage()];
            $this->dispatch('toast', type: 'error', message: 'Error clearing cache!');
        }

        $this->isClearing = false;
        $this->confirmAction = '';
    }

    private function clearAll()
    {
        Artisan::call('optimize:clear');
        $output = Artisan::output();
        
        // Additional manual clearing
        $this->clearDebugbar();
        $this->clearLogs();
        $this->clearTemp();
        $this->clearLivewire();

        $this->results[] = ['type' => 'success', 'message' => 'All caches cleared successfully!'];
        $this->results[] = ['type' => 'info', 'message' => 'Application cache, views, config, routes, events, compiled classes, debugbar, logs, temp files, and Livewire cache have been cleared.'];
    }

    private function clearViews()
    {
        Artisan::call('view:clear');
        $path = storage_path('framework/views');
        if (File::exists($path)) {
            File::cleanDirectory($path);
        }
        $this->results[] = ['type' => 'success', 'message' => 'View cache cleared successfully! (' . $this->viewCacheSize . ' freed)'];
    }

    private function clearAppCache()
    {
        Artisan::call('cache:clear');
        Cache::flush();
        $this->results[] = ['type' => 'success', 'message' => 'Application cache cleared successfully! (' . $this->appCacheSize . ' freed)'];
    }

    private function clearConfig()
    {
        Artisan::call('config:clear');
        $this->results[] = ['type' => 'success', 'message' => 'Configuration cache cleared successfully!'];
    }

    private function clearRoute()
    {
        Artisan::call('route:clear');
        $this->results[] = ['type' => 'success', 'message' => 'Route cache cleared successfully!'];
    }

    private function clearEvent()
    {
        Artisan::call('event:clear');
        $this->results[] = ['type' => 'success', 'message' => 'Event cache cleared successfully!'];
    }

    private function clearCompiled()
    {
        Artisan::call('clear-compiled');
        $this->results[] = ['type' => 'success', 'message' => 'Compiled classes cleared successfully!'];
    }

    private function optimize()
    {
        Artisan::call('optimize');
        $output = Artisan::output();
        $this->results[] = ['type' => 'success', 'message' => 'Application optimized successfully!'];
        $this->results[] = ['type' => 'info', 'message' => 'Cached config, routes, and events for better performance.'];
    }

    private function clearLivewire()
    {
        Artisan::call('livewire:discover');
        Artisan::call('livewire:configure-s3-upload-cleanup');
        
        // Clear Livewire specific files
        $path = storage_path('framework/cache/livewire');
        if (File::exists($path)) {
            File::cleanDirectory($path);
        }
        
        $this->results[] = ['type' => 'success', 'message' => 'Livewire cache cleared and components rediscovered!'];
    }

    private function clearDebugbar()
    {
        $path = storage_path('debugbar');
        if (File::exists($path)) {
            $files = File::files($path);
            $count = count($files);
            File::cleanDirectory($path);
            $this->results[] = ['type' => 'success', 'message' => "Debugbar storage cleared! ({$count} files removed)"];
        } else {
            $this->results[] = ['type' => 'info', 'message' => 'No debugbar storage found.'];
        }
    }

    private function clearLogs()
    {
        $logPath = storage_path('logs');
        if (File::exists($logPath)) {
            $files = File::files($logPath);
            $count = 0;
            $totalSize = 0;
            
            foreach ($files as $file) {
                if ($file->getExtension() === 'log' && $file->getFilename() !== '.gitignore') {
                    $totalSize += $file->getSize();
                    File::delete($file);
                    $count++;
                }
            }
            
            $this->results[] = ['type' => 'success', 'message' => "Log files cleared! ({$count} files, " . $this->formatBytes($totalSize) . " freed)"];
        }
    }

    private function clearTemp()
    {
        $tempPath = storage_path('app/temp');
        if (File::exists($tempPath)) {
            File::cleanDirectory($tempPath);
        }
        
        // Also clear tmp directory if exists
        $tmpPath = storage_path('tmp');
        if (File::exists($tmpPath)) {
            File::cleanDirectory($tmpPath);
        }
        
        $this->results[] = ['type' => 'success', 'message' => 'Temporary files cleared successfully!'];
    }

    public function closeConfirmModal()
    {
        $this->showConfirmModal = false;
        $this->confirmAction = '';
    }

    public function render()
    {
        return view('livewire.admin.clear-cache');
    }
}