<?php

namespace App\Services;

use Illuminate\Http\Request;

class ImageService
{
    public static function save(Request $request, String $folderName, String $requestField)
    {
        $filename = null;
        if ($request->hasFile($requestField)) {
            $image = $request->file($requestField);
            $filename = time() . "_" . preg_replace('/\s+/', '_', strtolower($image->getClientOriginalName()));
            $image->storeAs('public/' . $folderName . '/', $filename, 'local');
        }

        return $filename ? $folderName . '/' . $filename : null;
    }

    public static function multiSave(Request $request, String $folderName, String $requestArrayField, int $index)
    {
        $filename = null;
        if ($request->hasFile($requestArrayField)) {
            $images = $request->file($requestArrayField);
            $image = $images[$index];
            $filename = time() . "_" . preg_replace('/\s+/', '_', strtolower($image->getClientOriginalName()));
            $image->storeAs('public/' . $folderName . '/', $filename, 'local');
        }

        return $filename ? $folderName . '/' . $filename : null;
    }

    public static function privateSave(Request $request, String $folderName, String $requestField)
    {
        $filename = null;
        if ($request->hasFile($requestField)) {
            $image = $request->file($requestField);
            $filename = time() . "_" . preg_replace('/\s+/', '_', strtolower($image->getClientOriginalName()));
            $image->storeAs('private/' . $folderName . '/', $filename, 'local');
        }

        return $filename ? $folderName . '/' . $filename : null;
    }

    public static function privateMultiSave(Request $request, String $folderName, String $requestArrayField, int $index)
    {
        $filename = null;
        if ($request->hasFile($requestArrayField)) {
            $images = $request->file($requestArrayField);
            $image = $images[$index];
            $filename = time() . "_" . preg_replace('/\s+/', '_', strtolower($image->getClientOriginalName()));
            $image->storeAs('private/' . $folderName . '/', $filename, 'local');
        }

        return $filename ? $folderName . '/' . $filename : null;
    }
}
