<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Str;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    protected const IMG_PATH = __DIR__ . "/../../../public/images/";

    function move_file($file, $path = null)
    {
        if (!is_dir($x = $path ?? $this::IMG_PATH))
            mkdir($x, 0777, true);
        $img = Str::random(10) . now()->timestamp . '.' . $file->getClientOriginalExtension();
        return ["success" => $file->move($path ?? $this::IMG_PATH, $img), "filename" => $img];
    }
    function api_response($result)
    {
        return $result+["timestamp" => now()->timestamp];
    }
}
