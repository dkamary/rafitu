<?php

namespace App\Models\Managers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PostManager {
    public static function manageUpload(Request $request, string $fieldName, Page $page) : ?string {
        /**
         * @var UploadedFile $avatar
         */
        $file = $request->file($fieldName);
        if (!$file) {

            return null;
        }

        self::removePreviousFile($page ? $page->$fieldName : null);

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

    public static function getValidSlug(?string $suggestion = null) : string {
        if(!$suggestion) return uniqid('article-');
        $count = Page::where('slug', 'LIKE', $suggestion)->count();
        if($count == 0) return $suggestion;

        return $suggestion .'-' . ++$count;
    }
}
