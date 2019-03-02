<?php

namespace App\Http\Controllers;

use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\File;


class ImageController extends Controller
{

    public function getImageThumbnail($path, $width = null, $height = null, $school_code = "ys", $type = "fit", $file_ext = "")
    {
        $images_path = config('definitions.images_path') . "/" . $school_code;
        $path = ltrim($path, "/");

        //returns the original image if isn't passed width and height
        if (is_null($width) && is_null($height)) {
            return url("{$images_path}/" . $path);
        }

        //if thumbnail exist returns it
        if (File::exists(public_path("{$images_path}/thumbs/" . "{$width}x{$height}/" . $path))) {
            return url("{$images_path}/thumbs/" . "{$width}x{$height}/" . $path);
        }

        //If original image doesn't exists returns a default image which shows that original image doesn't exist.
        if (!File::exists(public_path("{$images_path}/" . $path))) {

            /*
             * 2 ways
             */

            //1. recursive call for the default image
            //return $this->getImageThumbnail("error/no-image.png", $width, $height, $type);

            //2. returns an image placeholder generated from placehold.it
            return "http://placehold.it/{$width}x{$height}";
        }

        $allowedMimeTypes = ['image/gif', 'image/png', 'image/jpeg', 'image/bmp', 'image/x-ms-bmp', 'image/webp'];
        $picFileExt = ['gif', 'png', 'jpeg', 'bmp', 'jpg'];

        // $contentType = mime_content_type("{$images_path}/" . $path);
        // $finfo = finfo_open(FILEINFO_MIME_TYPE);
        // dd (finfo_file($finfo, "{$images_path}/" . $path));
        // finfo_close($finfo);
        $contentType = mime_content_type("{$images_path}/" . $path);
        // var_dump($allowedMimeTypes);
        // dd($file_ext);
        if (in_array($file_ext, $picFileExt)) { //Checks if is an image
            Image::configure(array('driver' => 'imagick')); 
            $image = Image::make(public_path("{$images_path}/" . $path));

            switch ($type) {
                case "fit": {
                    $image->fit($width, $height, function ($constraint) {
                        $constraint->upsize();
                    });
                    break;
                }
                case "resize": {
                    //stretched
                    $image->resize($width, $height);
                }
                case "background": {
                    $image->resize($width, $height, function ($constraint) {
                        //keeps aspect ratio and sets black background
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });
                }
                case "resizeCanvas": {
                    $image->resizeCanvas($width, $height, 'center', false, 'rgba(0, 0, 0, 0)'); //gets the center part
                }
            }

            //relative directory path starting from main directory of images
            $dir_path = (dirname($path) == '.') ? "" : dirname($path);

            //Create the directory if it doesn't exist
            if (!File::exists(public_path("{$images_path}/thumbs/" . "{$width}x{$height}/" . $dir_path))) {
                File::makeDirectory(public_path("{$images_path}/thumbs/" . "{$width}x{$height}/" . $dir_path), 0775, true);
            }

            //Save the thumbnail
            $image->save(public_path("{$images_path}/thumbs/" . "{$width}x{$height}/" . $path));

            //return the url of the thumbnail
            return url("{$images_path}/thumbs/" . "{$width}x{$height}/" . $path);
        } else { //Checks if is an document
            $docFileExt = ['doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx'];
            $docMimeType = ["application/msword", 'application/x-xls', 'application/vnd.ms-excel', 'application/x-ppt', 'application/vnd.ms-powerpoint'];
            if (in_array($file_ext, ["doc", "docx"])) {
                return url("images/doc.png");
                // return "http://10.63.7.189/op/embed.aspx?src=http%3A%2F%2Fwww.oic.com%3A8001%2Fposts%2F%E5%91%B3%E9%81%93.docx-5b96766db52f2.docx";
            } elseif (in_array($file_ext, ["xls", 'xlsx'])) {
                return url("images/xls.png");
            } elseif (in_array($file_ext, ["ppt", "pptx"])) {
                return url("images/ppt.png");
            } elseif (in_array($file_ext, ["sb2"])) {
                return url("images/scratch.png");
            } else {
                return "http://placehold.it/{$width}x{$height}";
            }
        }
    }
}