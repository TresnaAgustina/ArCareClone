<?php

use App\Models\Ticket;
use Carbon\Carbon;

if (! function_exists('ticket_code')) {
    function ticket_code()
    {
        // Generate kode tiket, format: TK-<bulan:08><tahun:24><autoIncrement: 0001>
        $bulan = Carbon::now()->format('m');
        $tahun = Carbon::now()->format('y');
        // count all tickets and add 1
        $count = Ticket::count() + 1;
        $increment = str_pad($count, 4, '0', STR_PAD_LEFT);

        $kodeTiket = "TK$bulan$tahun-$increment";

        return $kodeTiket;
    }
}



