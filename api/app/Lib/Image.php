<?php

namespace App\Lib;


class Image
{
    public static function store($blob, $fileTyype) {

        $filename = md5(date('Y-m-d h:i:s'));
        $extension = substr($fileTyype, strpos($fileTyype, "/") + 1);
        $filename .= ".".$extension;

        if(file_put_contents($filename, base64_decode($blob)))
        {
            return $filename;
        }

        return false;
    }
}