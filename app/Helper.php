<?php

namespace App;

use Intervention\Image\Facades\Image;

if(! function_exists('saveImage')){
    function saveImage($image)
    {
        dd($image);
        $image = Image::make($image);
    }
}
