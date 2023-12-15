<?php

namespace App\Helpers;

class LoanHelpers
{
    public static function getStatus($id)
    {
        $statusDescriptions = [
            0 => 'Sedang Menunggu Konfirmasi',
            1 => 'Sedang Dipinjam',
            2 => 'Telah Jatuh Tempo',
            3 => 'Ditolak',
            4 => 'Telah Dikembalikan',
        ];

        return $statusDescriptions[$id];
    }
}
