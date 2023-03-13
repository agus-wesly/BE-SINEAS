<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait ImageTrait
{
    public function uploadImage(string $image, $file, string $path): string
    {
        return $file->file($image)->store(
            'assert/' . $path,
            'public'
        );
    }

    public function deleteImage(string $image): void
    {
        if (file_exists($image)) {
            unlink($image);
        }
    }

}
