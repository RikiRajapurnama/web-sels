<?php

namespace App\Http\Controllers\Concerns;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

trait UploadsImages
{
    protected function storeImage(?UploadedFile $file, string $folder = 'uploads', ?string $old = null): ?string
    {
        if (!$file) {
            return $old;
        }

        $name = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs($folder, $name, 'public');

        if ($old) {
            $this->deleteImage($old);
        }

        return $path;
    }

    protected function deleteImage(?string $path): void
    {
        if ($path) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($path);
        }
    }
}
