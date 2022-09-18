<?php

namespace App\Helpers;

use App\File;

class Image
{
    public static $sizes = [
        'thumbnail' => [150, 150], // 1:1
        'small' => [370, 222], // 5:3
        'medium' => [740, 444], // 5:3
        'large' => [1024, 615], // 5:3
    ];

    /**
     * php artisan images:regenerate
     */
    public static function regenerateImages()
    {
        $images = File::select(['file'])->whereIn('extension', ['jpg', 'jpeg', 'png', 'gif'])->get();
        foreach ($images as $image) {
            self::createImageSizes($image->file);
        }
    }

    /**
     * php artisan images:deleteRegeneratedSizes
     */
    public static function deleteRegeneratedSizes()
    {
        $images = File::select(['file'])->whereIn('extension', ['jpg', 'jpeg', 'png', 'gif'])->get();
        foreach ($images as $image) {
            $image_path = public_path($image->file);

            $file_info = pathinfo($image_path);

            array_map(
                'unlink',
                (array)@glob($file_info['dirname'] . DS . $file_info['filename'] . "-*." . $file_info['extension'])
            );
        }
    }

    public static function deleteImage($image_url)
    {
        $image_path = public_path($image_url);

        $file_info = pathinfo($image_path);

        @unlink($image_path);

        array_map(
            'unlink',
            (array)@glob($file_info['dirname'] . DS . $file_info['filename'] . "-*." . $file_info['extension'])
        );
    }

    /**
     * @param string $image_path Image from file
     * @param int $thumb_width The new image width
     * @param int $thumb_height The new image height
     * @param int $quality
     *
     * @see https://gist.github.com/jhbsk/4339969
     */
    public static function createImageSizes(string $image_path)
    {
        $image_path = public_path($image_path);

        if (!file_exists($image_path)) {
            return;
        }

        $file_info = pathinfo($image_path);

        $quality = [
            'jpg' => 90,
            'jpeg' => 90,
            'png' => 9,
            'gif' => 0,
        ];

        $sizes = self::$sizes;

        $image = self::imageCreateFromFile($image_path, $file_info['extension']);
        $width = imagesx($image);
        $height = imagesy($image);

        foreach ($sizes as $size) {
            $thumb_width = $size[0];
            $thumb_height = $size[1];

            $filename = $file_info['dirname'] . DS . $file_info['filename'] . '-' . $thumb_width . 'x' . $thumb_height
                . '.' . $file_info['extension'];

            $original_aspect = $width / $height;
            $thumb_aspect = $thumb_width / $thumb_height;

            if ($original_aspect >= $thumb_aspect) {
                // If image is wider than thumbnail (in aspect ratio sense)
                $new_height = $thumb_height;
                $new_width = $width / ($height / $thumb_height);
            } else {
                // If the thumbnail is wider than the image
                $new_width = $thumb_width;
                $new_height = $height / ($width / $thumb_width);
            }

            $thumb = imagecreatetruecolor($thumb_width, $thumb_height);

            // Make new image transparent https://stackoverflow.com/a/46564622/1794834
            $transparent = imagecolorallocatealpha($thumb, 0, 0, 0, 127);
            imagefill($thumb, 0, 0, $transparent);
            imagesavealpha($thumb, true);

            // Resize and crop
            imagecopyresampled(
                $thumb,
                $image,
                0 - ($new_width - $thumb_width) / 2, // Center the image horizontally
                0 - ($new_height - $thumb_height) / 2, // Center the image vertically
                0,
                0,
                $new_width,
                $new_height,
                $width,
                $height
            );
            self::imageFile($thumb, $filename, $quality, $file_info['extension']);
            imagedestroy($thumb);
        }

        imagedestroy($image);

        return;
    }

    protected static function imageCreateFromFile($filename, $extension)
    {
        switch (strtolower($extension)) {
            case 'jpeg':
            case 'jpg':
                return imagecreatefromjpeg($filename);
                break;

            case 'png':
                return imagecreatefrompng($filename);
                break;

            case 'gif':
                return imagecreatefromgif($filename);
                break;
        }
    }

    protected static function imageFile($image, $to, $quality, $extension)
    {
        switch (strtolower($extension)) {
            case 'jpeg':
            case 'jpg':
                return imagejpeg($image, $to, $quality[$extension]);
                break;

            case 'png':
                return imagepng($image, $to, $quality[$extension]);
                break;

            case 'gif':
                return imagegif($image, $to);
                break;
        }
    }

    /**
     * @param string $image_path
     * @return bool
     *
     * @see https://secure.php.net/manual/en/function.imagecreatefromgif.php#59787
     */
    public static function isAnimatedGif(string $image_path)
    {
        $fileContents = file_get_contents($image_path);

        $str_loc = 0;
        $count = 0;

        // There is no point in continuing after we find a 2nd frame
        while ($count < 2) {
            $where1 = strpos($fileContents, "\x00\x21\xF9\x04", $str_loc);
            if ($where1 === false) {
                break;
            } else {
                $str_loc = $where1 + 1;
                $where2 = strpos($fileContents, "\x00\x2C", $str_loc);
                if ($where2 === false) {
                    break;
                } else {
                    if ($where1 + 8 == $where2) {
                        $count++;
                    }
                    $str_loc = $where2 + 1;
                }
            }
        }

        if ($count > 1) {
            return true;
        }

        return false;
    }
}
