<?php

namespace App\Models\Managers;

use App\Models\User;
use GdImage;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Throwable;

class AvatarManager
{
    const SIZES = [
        'thumbnail' => ['w' => 64, 'h' => 64],
        'preview' => ['w' => 256, 'h' => 256],
        'small' => ['w' => 512, 'h' => 512],
        'medium' => ['w' => 1024, 'h' => 1024],
        'large' => ['w' => 1200, 'h' => 1200],
    ];
    const SIZE_THUMBNAIL = 'thumbnail';
    const SIZE_PREVIEW = 'preview';
    const SIZE_SMALL = 'small';
    const SIZE_MEDIUM = 'medium';
    const SIZE_LARGE = 'large';

    public static function handleUpload(Request $request, string $fieldName = 'avatar', ?User $user = null): ?string
    {
        /**
         * @var UploadedFile $avatar
         */
        $avatar = $request->file($fieldName);
        if (!$avatar) {

            return null;
        }

        self::removePreviousAvatar($user->avatar);

        $uniqId = uniqid($fieldName . '-');
        $oldExtension = $avatar->getClientOriginalExtension();
        $original = $uniqId . '.' . $oldExtension;
        $avatar->move(public_path('avatars/'), $original);
        $newExtension = strtolower($oldExtension) == 'svg' ? '.svg' : '.webp';
        $filename = $uniqId . $newExtension;

        if(!self::resizeAvatar($original)) {
            session()->flash('warning', 'Une erreur est survenue lors de la mise à jour de l\'avatar');

            return null;
        }

        return $filename;
    }

    public static function removePreviousAvatar(?string $file = null) : bool {
        if(!$file) return false;

        $avatar = AVATAR_DIR . $file;
        $pathInfo = pathinfo($file);
        $filename = $pathInfo['filename'];
        if(is_file($avatar)) {
            foreach(self::SIZES as $label => $size) {
                $file = $filename .'-' . $label .'.' .$pathInfo['extension'];
                unlink(AVATAR_DIR . $file);
            }

            return unlink($avatar);
        }

        return false;
    }

    public static function resizeAvatar(string $filename) : bool {
        $pathInfo = pathinfo($filename);
        $file = AVATAR_DIR . $filename;
        try {
            $ext = self::getImageExtension($file);

            if($ext == 'svg') return true;

            $image = self::getImage($file, $ext);

            if(!$image) return false;

            foreach(self::SIZES as $label => $s) {
                $newImg = imagescale($image, $s['w'], -1);
                $newFilename = $pathInfo['filename'] .'-' .$label .'.webp';
                $isSaved = self::saveImageWebp($newImg, AVATAR_DIR . $newFilename);
            }
        } catch(Throwable $th) {
            throw $th;
        }

        return true;
    }

    public static function getImageExtension(string $fullpath) : ?string {
        $pathInfo = pathinfo($fullpath);
        if(strtolower($pathInfo['extension']) == 'svg') return 'svg';

        $size = getimagesize($fullpath);
        if(!$size) return null;

        $mime = $size['mime'];
        $ext = null;

        if($mime == 'image/png') $ext = 'png';
        elseif($mime == 'image/webp') $ext = 'webp';
        elseif($mime == 'image/gif') $ext = 'gif';
        elseif($mime == 'image/jpeg') $ext = 'jpg';

        return $ext;
    }

    public static function getImage(string $filename, ?string $ext = null) {
        $ext = $ext ?: self::getImageExtension($filename);
        if($ext == 'jpg') return imagecreatefromjpeg($filename);
        if($ext == 'png') return imagecreatefrompng($filename);
        if($ext == 'webp') return imagecreatefromwebp($filename);
        if($ext == 'gif') return imagecreatefromgif($filename);

        return null;
    }

    public static function saveImage($gdImage, string $filename) : bool {
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if($ext == 'jpg') return imagejpeg($gdImage, $filename, 75);
        if($ext == 'png') return imagepng($gdImage, $filename);
        if($ext == 'webp') return imagewebp($gdImage, $filename);
        if($ext == 'gif') return imagegif($gdImage, $filename);

        return false;
    }

    public static function saveImageWebp($gdImage, string $filename) : bool {
        return imagewebp($gdImage, $filename);
    }
}
