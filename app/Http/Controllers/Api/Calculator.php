<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Calculator extends Controller
{
    public function slug(string $slug) {
        $limitedVersion = substr($slug, 0, 40);
        return Str::slug($limitedVersion);
    }
}
