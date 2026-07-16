<?php

namespace App\Traits;

use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Throwable;

trait HandlesUploads
{
    use WithFileUploads;

    /**
     * Reusable, Secure & Advanced File Upload/Update Function
     * Optimized for Production (Linux/Ubuntu Permission Friendly)
     * 
     * @param mixed $file (Livewire Temporary File)
     * @param string $directory (Folder name inside storage/app/public/)
     * @param string|null $oldFilePath (Old relative path from DB for cleanup)
     * @return string|null (Relative path for Database)
     */
    public function uploadFile($file, string $directory = 'uploads', ?string $oldFilePath = null): ?string
    {
        // 1. Agar nai file upload nahi hui, to purana path hi return karein
        if (!$file) {
            return $oldFilePath;
        }

        try {
            // 2. Safayi (Cleanup): Purani file storage se remove karein
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

            // 6. File Store karein (storage/app/public/{directory}/{filename})
            $path = $file->storeAs($directory, $fileName, 'public');

            if (!$path) {
                throw new \Exception("File could not be stored on 'public' disk.");
            }

            // 7. Ubuntu Permission Fix (Code Level):
            // uploaded file par read/write permissions set karna taake bad me deletion/access me error na aye
            $absolutePath = Storage::disk('public')->path($path);
            if (file_exists($absolutePath)) {
                chmod($absolutePath, 0664); // Owner and Group can read/write, others can only read
            }

            return $path;

        } catch (Throwable $e) {
            // Log the error for production debugging
            Log::error('File Upload Failed in HandlesUploads Trait: ' . $e->getMessage(), [
                'directory' => $directory,
                'file_name' => $file->getClientOriginalName() ?? 'N/A'
            ]);

            // Agar upload fail ho jaye to null return karein ya aap standard exception bhy throw kar sakte hain
            return null;
        }
    }

    /**
     * Reusable File Deletion (Linux Permission & Exception Friendly)
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
            if (Storage::disk('public')->exists($filePath)) {
                return Storage::disk('public')->delete($filePath);
            }
        } catch (Throwable $e) {
            Log::warning('File Deletion Failed in HandlesUploads Trait: ' . $e->getMessage(), [
                'file_path' => $filePath
            ]);
        }

        return false;
    }
}