<?php

namespace App\Helpers;

use App\File;
use Illuminate\Support\Str;

class Upload
{
    /**
     * @param string $name
     * @return \App\File|null
     */
    public static function process(string $name)
    {
        $uploaded_file = request()->file($name);

        if (!$uploaded_file) {
            return null;
        }

        //\Log::info(print_r($uploaded_file, true));

        $file_ext = strtolower($uploaded_file->extension());
        $file_mime = $uploaded_file->getMimeType();
        $file_client_name = Str::substr(
            trim(pathinfo($uploaded_file->getClientOriginalName(), PATHINFO_FILENAME)),
            0,
            100
        );

        //$file_name = time() . '-' . strtolower(str_random(10)) . '.' . $file_ext;
        //$file_name = time() . '-' . rand(11111, 99999) . '.' . $file_ext;
        $file_name = time() . '-' . \App\AppModel::cakeSlug($file_client_name) . '.' . $file_ext;

        $uploads_dir = 'uploads' . DS . date("Y") . DS . date("m") . DS;

        $file_directory_path = public_path($uploads_dir);

        $file_path = '/' . $uploads_dir . $file_name;

        $uploaded_file->move($file_directory_path, $file_name);

        $file_meta = [];
        if (in_array($file_ext, ['jpg', 'jpeg', 'png', 'gif'])) {
            \App\Helpers\Image::createImageSizes($file_path);

            $image_details = getimagesize(public_path($file_path));

            $file_meta['width'] = $image_details[0];
            $file_meta['height'] = $image_details[1];
            $file_meta['sizes'] = \App\Helpers\Image::$sizes;
        }

        $file = new File;

        $file->user_id = auth()->id();
        $file->name = $file_client_name;
        $file->file = $file_path;
        $file->extension = $file_ext;
        $file->type = $file_mime;
        $file->size = @filesize(public_path($file_path));
        $file->sha1sum = @sha1_file(public_path($file_path));
        $file->meta = $file_meta;

        $file->save();

        // Delete old featured image
        //\App\Helpers\Image::deleteImage($article->featured_image);

        return $file;
    }
}
