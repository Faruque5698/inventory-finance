<?php

namespace App\Helpers\Classes;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileManage
{
    /**
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $path
     * @return string $url
     */
    public static function fileUpload($file, $path): string
    {
        $fileName = now()->format('Y-m-d_H-i-s').'_'.Str::random(20) . '.' . $file->getClientOriginalExtension();
        $storedPath = $file->storeAs($path, $fileName, 'public');

        return Storage::url($storedPath);
    }

    /**
     * @param string $url
     * @return bool
     */
    public static function fileDelete(string $url): bool
    {
        $relativePath = str_replace('/storage/', '', $url);

        if (Storage::disk('public')->exists($relativePath)) {
            return Storage::disk('public')->delete($relativePath);
        }

        return false;
    }
}
