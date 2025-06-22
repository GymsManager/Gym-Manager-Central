<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait HandlesFileAttributes
{

    public function setAttribute($key, $value)
    {
<<<<<<< HEAD
        if (in_array($key, $this->fileAttributes)) {
            if (request()->hasFile($key)) {
                $this->deleteFile($key);

                $file = request()->file($key);
                $path = $file->store("uploads/{$this->getTable()}");

                return parent::setAttribute($key, $path);
            }

            return parent::getAttribute($key);
        }

=======
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
>>>>>>> 51bd07d (Gym-review)
        return parent::setAttribute($key, $value);
    }

    public function getAttribute($key)
    {
        $value = parent::getAttribute($key);
<<<<<<< HEAD

        if (in_array($key, $this->fileAttributes) && $value) {
            return Storage::url($value);
        }

=======
        if (in_array($key, $this->fileAttributes) && $value) {
            return Storage::url($value);
        }
>>>>>>> 51bd07d (Gym-review)
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
