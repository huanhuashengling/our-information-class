<?php

function getThumbnail($img_path, $width, $height, $school_code, $type = "fit", $file_ext)
{
    return app('App\Http\Controllers\ImageController')->getImageThumbnail($img_path, $width, $height, $school_code, $type, $file_ext);
}