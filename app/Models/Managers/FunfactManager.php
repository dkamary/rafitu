<?php

namespace App\Models\Managers;

use App\Models\Funfact;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FunfactManager {
    public static function getAll() : Collection {
        return Funfact::where('is_active', '=', 1)->get();
    }

    public static function getOne(int $id) : ?Funfact {
        return Funfact::where('id', '=', $id)->first();
    }

    public static function create(array $data) : Funfact {
        return Funfact::create($data);
    }

    public static function handleUpload(Request $request, string $fieldName, ?Funfact $funfact = null): ?string
    {
        /**
         * @var UploadedFile $avatar
         */
        $file = $request->file($fieldName);
        if (!$file) {

            return null;
        }

        self::removePreviousFile($funfact ? $funfact->$fieldName : null);

        $uniqId = uniqid($fieldName . '-');
        $oldExtension = $file->getClientOriginalExtension();
        $original = $uniqId . '.' . $oldExtension;
        $file->move(public_path('images/'), $original);
        $newExtension = strtolower($oldExtension);
        $filename = $uniqId . '.' .$newExtension;

        return $filename;
    }

    public static function removePreviousFile(?string $file = null) : bool {
        if(!$file) return false;

        $tmpFile = IMAGES_DIR . $file;
        if(is_file($tmpFile)) {
            try {
                unlink($tmpFile);
            } catch(\Throwable $th) {
                Log::warning(sprintf('Erreur dans la suppression du fichier `%s`: %s', $tmpFile, $th->getMessage()), [
                    'code' => $th->getCode(),
                    'file' => $th->getFile(),
                    'line' => $th->getLine()
                ]);
            }

            return true;
        }

        return false;
    }
}
