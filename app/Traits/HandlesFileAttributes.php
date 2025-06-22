<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait HandlesFileAttributes
{

    public function setAttribute($key, $value)
    {
        if (property_exists($this, 'fileAttributes') && in_array($key, $this->fileAttributes)) {
            if (request()->hasFile($key)) {
                $this->deleteFile($key);
                $file = request()->file($key);
                $path = $file->store("uploads/{$this->getTable()}", 'public');
                return parent::setAttribute($key, $path);
            }
            // If value is an UploadedFile (e.g. from tests), handle it
            if ($value instanceof \Illuminate\Http\UploadedFile) {
                $this->deleteFile($key);
                $path = $value->store("uploads/{$this->getTable()}", 'public');
                return parent::setAttribute($key, $path);
            }
            // If value is a string (e.g. from fill()), just set it
            return parent::setAttribute($key, $value);
        }
        return parent::setAttribute($key, $value);
    }

    public function getAttribute($key)
    {
        $value = parent::getAttribute($key);
        if (in_array($key, $this->fileAttributes) && $value) {
            return Storage::url($value);
        }
        return $value;
    }

    public function deleteFile(string $key): void
    {
        $old = parent::getAttribute($key);

        if ($old && Storage::exists($old)) {
            Storage::delete($old);
        }
    }

    public static function bootHandlesFileAttributes(): void
    {
        static::deleting(function ($model) {
            foreach ($model->fileAttributes as $key) {
                $model->deleteFile($key);
            }
        });
    }
}
