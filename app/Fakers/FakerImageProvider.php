<?php


namespace App\Fakers;


use Faker\Provider\Base;
use Illuminate\Http\UploadedFile ;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FakerImageProvider extends Base
{
    public function lorem_flickr(string $dir = '', int $width = 320, int $height = 240): string
    {
        $name = $dir.'/'.Str::random(6).'.jpg';
        Storage::put($name, file_get_contents("https://loremflickr.com/g/$width/$height/computer"));
        return '/storage/'.$name;
    }

}
