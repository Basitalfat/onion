<?php

if (!function_exists('bulanIndo')) {
    function bulanIndo($bulan) {
        $namaBulan = [
            1 => 'Muharram',
            2 => 'Shafar',
            3 => 'Rabiul Awal',
            4 => 'Rabiul Akhir',
            5 => 'Jumadil Awal',
            6 => 'Jumadil Akhir',
            7 => 'Rajab',
            8 => 'Sya’ban',
            9 => 'Ramadhan',
            10 => 'Syawal',
            11 => 'Dzulqa’dah',
            12 => 'Dzulhijjah',
        ];
        return $namaBulan[(int) $bulan] ?? '...';
    }
}
