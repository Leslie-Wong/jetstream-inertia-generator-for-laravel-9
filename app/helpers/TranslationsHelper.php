<?php

namespace App\Helpers;

class TranslationsHelper
{
    static function translations($json)
    {
        if(!file_exists($json)) {
        return [];
        }
        return json_decode(file_get_contents($json), true);
    }
}
