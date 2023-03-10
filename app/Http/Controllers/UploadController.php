<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\View\View;

class UploadController extends Controller
{
    const EXTENSIONS_ALLOWED = ['jpg', 'png', 'gif', 'webp', 'pdf'];

    public function __construct()
    {
        $this->middleware('auth.admin');
    }

    public function index() : View {
        return view('');
    }

    public function upload(Request $request) :JsonResponse {
        /**
         * @var UploadedFile $media
         */
        $media = $request->file('file');
        if(!$media) {

            return response()->json([
                'done' => false,
                'message' => 'Media is empty',
            ]);
        }

        $extension = strtolower($media->getClientOriginalExtension());

        if(!in_array($extension, self::EXTENSIONS_ALLOWED)) {

            return response()->json([
                'done' => false,
                'message' => sprintf('L\'extension de fichier `%s` n\'est pas autorisé', $extension),
            ]);
        }

        $originalFilename = $media->getClientOriginalName();
        $pathInfo = pathinfo($originalFilename);

        $filename = Str::slug($pathInfo['filename'], '-');
        $newFilename = $filename .'.'.$extension;
        $suffix = 0;
        while(is_file(PUBLIC_DIR . 'avatars' . DIRECTORY_SEPARATOR . $newFilename)) {
            $newFilename = sprintf(
                '%s-%s.%s',
                $filename,
                str_pad(++$suffix, 3, '0', STR_PAD_LEFT),
                $extension
            );
        }
        $media->move(public_path('uploads/'), $newFilename);

        return response()->json([
            'done' => true,
            'message' => sprintf('Fichier `%s` a été uploadé sous le nom `%s` dans le répertoire `/avatars`', $media->getClientOriginalName(), $newFilename),
            'location' => asset('uploads/' . $newFilename),
        ]);
    }

    public function remove(Request $request) : JsonResponse {
        $filename = $request->input('filename');
        if(!is_file(PUBLIC_DIR . 'avatars' . DIRECTORY_SEPARATOR . $filename)) {

            return response()->json([
                'done' => false,
                'message' => sprintf('Le fichier `%s` est introuvable dans le répertoire /uploads', $filename),
            ]);
        }
        unlink(PUBLIC_DIR . 'avatars' . DIRECTORY_SEPARATOR . $filename);

        return response()->json([
            'done' => true,
            'message' => sprintf('Le fichier `%s` a été effacé', $filename),
        ]);
    }
}
