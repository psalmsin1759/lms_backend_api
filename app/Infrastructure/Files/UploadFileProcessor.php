<?php

namespace App\Infrastructure\Files;

use App\Exceptions\ApiException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadFileProcessor
{
    /**
     * Process and upload a file using the default storage provider
     */
    public function handle(
        UploadedFile $file,
        string $directory,
        ?string $filename = null
    ): array {
        $disk = $this->resolveDisk();

        $storedFilename = $filename
            ? $this->sanitizeFilename($filename, $file)
            : $this->generateFilename($file);

        $path = Storage::disk($disk)->putFileAs(
            $directory,
            $file,
            $storedFilename
        );

        if (!$path) {
            throw new ApiException('File upload failed');
        }

        return [
            'disk'        => $disk,
            'path'        => $path,
            'url'         => $this->fileUrl($disk, $path),
            'original'    => $file->getClientOriginalName(),
            'mime_type'   => $file->getClientMimeType(),
            'size'        => $file->getSize(),
        ];
    }

    /**
     * Resolve storage disk from env/config
     */
    private function resolveDisk(): string
    {
        $provider = config('files.default_provider');

        return config("files.disks.{$provider}")
            ?? throw new ApiException("Invalid file storage provider [{$provider}]");
    }

    /**
     * Generate safe unique filename
     */
    private function generateFilename(UploadedFile $file): string
    {
        return Str::uuid() . '.' . $file->getClientOriginalExtension();
    }

    /**
     * Sanitize custom filename
     */
    private function sanitizeFilename(string $filename, UploadedFile $file): string
    {
        $name = Str::slug(pathinfo($filename, PATHINFO_FILENAME));
        $ext  = $file->getClientOriginalExtension();

        return "{$name}.{$ext}";
    }

    /**
     * Generate public URL
     */
    private function fileUrl(string $disk, string $path): string
    {
        return Storage::disk($disk)->url($path);
    }

    public function delete(string $path): void
    {
        $disk = $this->resolveDisk();

        if (Storage::disk($disk)->exists($path)) {
            Storage::disk($disk)->delete($path);
        }
    }

    /**
     * Convert a public URL back to storage path
     */
    public function pathFromUrl(string $url): string
    {
        $disk = $this->resolveDisk();
        $baseUrl = Storage::disk($disk)->url('');

        return str_replace($baseUrl, '', $url);
    }

}
