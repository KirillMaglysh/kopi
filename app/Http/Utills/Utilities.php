<?php

namespace App\Http\Utills;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class Utilities
{
    /**
     * @param Request $request
     * @param string $keyName
     * @param string $dir
     * @param mixed $data
     * @return array
     */
    public static function hashPhoto(Request $request, string $keyName, string $dir, mixed $data): array
    {
        $photoCardFile = $request->file($keyName);
        $hashPhotoCard = Hash::make($photoCardFile);
        $hashPhotoCard = str_replace('/', 'a', $hashPhotoCard);
        $data[$keyName] = $hashPhotoCard;

        $photoCardFile->storeAs('temp');
        $photoCardFile->move(public_path('storage/' . $dir . '/'), $hashPhotoCard . '.jpg');

        return $data;
    }
}
