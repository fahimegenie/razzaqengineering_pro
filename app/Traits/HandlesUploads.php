<?php

namespace App\Traits;

use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Throwable;

trait HandlesUploads
{
    use WithFileUploads;

    /**
     * Reusable, Secure & Advanced File Upload/Update Function
     * Strictly uses public root folder (No Laravel Storage Disks)
     * 
     * @param mixed $file (Livewire Temporary File)
     * @param string $directory (Folder name inside root public/, e.g., 'services')
     * @param string|null $oldFilePath (Old relative path from DB for cleanup)
     * @return string|null (Relative path for Database)
     */
    public function uploadFile($file, string $directory = 'uploads', ?string $oldFilePath = null): ?string
    {
        $directory = 'uploads/'.$directory;
        $oldFilePath = 'uploads/'.$oldFilePath;
        // 1. Agar nai file upload nahi hui, to purana path hi return karein
        if (!$file) {
            return $oldFilePath;
        }

        try {
            // 2. Safayi (Cleanup): Purani file public folder se remove karein
            if ($oldFilePath) {
                $this->deleteFile($oldFilePath);
            }

            // 3. File extension extract aur sanitize karein
            $extension = strtolower($file->getClientOriginalExtension());

            // 4. Double Collision Protection (Unique Name)
            $uniqueId = Str::random(12) . '_' . str_replace('.', '', microtime(true));
            $fileName = $uniqueId . '.' . $extension;

            // 5. Clean & Standardize Directory Path
            $directory = trim($directory, '/');
            
            // Root public path (e.g., /var/www/html/.../public/services)
            $targetDir = public_path($directory);

            // Agar directory nahi bani hui to base public folder ke rights use karte hue create karein
            if (!file_exists($targetDir)) {
                @mkdir($targetDir, 0777, true);
            }

            // 6. RAW PHP MOVE: Livewire ke temp path se file copy/move karein direct public folder mein
            // Yeh livewire object ke underlying real path ko check karega
            $tempRealPath = $file->getRealPath();
            $destinationPath = $targetDir . '/' . $fileName;

            if (!move_uploaded_file($tempRealPath, $destinationPath)) {
                // Agar move_uploaded_file restrict ho (kyunke temporary file standard $_FILES se thodi hat kar hoti hai livewire mein)
                // Toh hum safe file stream copy use karenge jo permission bypass kar jati hai
                if (!copy($tempRealPath, $destinationPath)) {
                    throw new \Exception("Could not copy or move file to target public directory: " . $destinationPath);
                }
                // Copy karne ke baad temporary file ko clean up karna
                @unlink($tempRealPath);
            }
            
            // Database ke liye relative path (e.g., "services/filename.jpg")
            $path = $directory . '/' . $fileName;

            // 7. Ubuntu/Linux Permission Fix (Code Level):
            if (file_exists($destinationPath)) {
                @chmod($destinationPath, 0664); // Owner and Group read/write, others read only
            }

            return $path;

        } catch (Throwable $e) {
            Log::error('File Upload Failed in HandlesUploads Trait: ' . $e->getMessage(), [
                'directory' => $directory,
                'file_name' => $file->getClientOriginalName() ?? 'N/A'
            ]);

            return null;
        }
    }

    /**
     * Reusable File Deletion from Direct Public Folder (No Storage)
     * 
     * @param string|null $filePath
     * @return bool
     */
    public function deleteFile(?string $filePath): bool
    {
        if (!$filePath) {
            return false;
        }

        try {
            $absolutePath = public_path($filePath);
            
            if (file_exists($absolutePath)) {
                return @unlink($absolutePath);
            }
        } catch (Throwable $e) {
            Log::warning('File Deletion Failed in HandlesUploads Trait: ' . $e->getMessage(), [
                'file_path' => $filePath
            ]);
        }

        return false;
    }
}