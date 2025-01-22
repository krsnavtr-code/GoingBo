<?php

namespace App\Http\Controllers\BaseControllers;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;

class PackageBase extends Controller
{
    function get_packages()
    {
        return Package::all()->toArray();
    }
    function get_packageById($pkgId)
    {
        return Package::find($pkgId)->toArray();
    }

    function ui_view_packages()
    {
    }
    function ui_view_package()
    {
    }
}
