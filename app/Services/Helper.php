<?php

namespace App\Services;

use Illuminate\Support\Str;

class Helper
{
    public static function slug($str): string
    {
        $slug = Str::of($str)->trim()->slug('-');
        return $slug . '_' . Str::random(10);
    }
}
