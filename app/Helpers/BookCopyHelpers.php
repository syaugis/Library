<?php

namespace App\Helpers;

class BookCopyHelpers
{
    public static function getAvailable($id)
    {
        $availableDescriptions = [
            0 => 'Tidak Tersedia',
            1 => 'Buku Tersedia',
        ];

        return $availableDescriptions[$id];
    }
}
