<?php

use App\Enums\OrderStatusEnum;
use App\Services\SettingsService;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;




if (!function_exists('saveImage')) {
    function saveImage($image, $withThumbnail = false): string
{
    $img = Image::make($image->getRealPath());
        $img->stream();
        $name = date("Y/m/d") . "/" . rand(11111, 99999) . '.' . $image->getClientOriginalExtension();
        if (Tenant()) {
            $name = Tenant()->id . "/" . date("Y/m/d") . "/" . rand(11111, 99999) . '.' . $image->getClientOriginalExtension();
        }
        Storage::disk('public')->put($name, $img, 'public');
        if ($withThumbnail == true) {
            saveThumbnail($image, $name);
        }
        return $name;
    }
}

if (!function_exists('saveThumbnail')) {
    function saveThumbnail($image, $name): string
    {
        $img = Image::make($image->getRealPath());
        $img->resize(
            360,
            360,
            function ($constraint) {
                $constraint->aspectRatio();
            }
        );
        $img->stream();
        $name = "thumbnails/" . $name;
        Storage::disk('public')->put($name, $img, 'public');
        return $name;
    }
}

if (!function_exists('saveFiles')) {
    function saveFiles($file): string
    {
        $name = date("Y/m/d") . "/" . rand(11111, 99999) . '.' . $file->getClientOriginalExtension();
        if (Tenant()) {
            $name = Tenant()->id . "/" . date("Y/m/d") . "/" . rand(11111, 99999) . '.' . $file->getClientOriginalExtension();
        }
        $filename = $file->storeAs('/', $name, ['disk' => 'public']);
        return $filename;
    }
}



if (!function_exists('generateRandomEnglishString')) {
    function generateRandomEnglishString($size): string
    {
        return substr(
            str_shuffle(
                str_repeat(
                    $x = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
                    ceil($size / strlen($x))
                )
            ),
            1,
            $size
        );
    }
}



if (!function_exists('filterArray')) {
    function filterArray($arr, $key, $needle)
    {
        foreach ($arr as $record) {
            if ($record[$key] == $needle) {
                return $record;
            }
        }
        return false;
    }
}



if (!function_exists('getFileLimit')) {
    function getFileLimit()
    {
        return (int) config('app.one_file_size')  * 1024;
    }
}
