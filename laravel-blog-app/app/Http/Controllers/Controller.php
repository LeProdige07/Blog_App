<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\URL;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function saveImage($image, $path = 'public')
    {
        if (!$image) {
            return null;
        }

        $filemane = time().'.png';

        //save image
        \Storage::disk($path)->put($filemane, base64_decode($image));

        //return the path
        //Url is the base url exp: localhost:8000
        return URL::to('/').'/storage'.$path.'/'.$filemane;
    }

}
