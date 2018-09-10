<?php

function getThumbnail($img_path, $width, $height, $type = "fit", $file_ext)
{
    return app('App\Http\Controllers\ImageController')->getImageThumbnail($img_path, $width, $height, $type, $file_ext);
}