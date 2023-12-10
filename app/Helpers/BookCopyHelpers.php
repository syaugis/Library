<?php

namespace App\Helpers;

class LoanHelpers
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
