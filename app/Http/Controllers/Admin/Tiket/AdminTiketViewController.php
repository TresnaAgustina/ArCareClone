<?php

namespace App\Http\Controllers\Admin\Tiket;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\TicketLog;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminTiketViewController extends Controller
{
    function index() : object {
        try {
            //code...
        } catch (\Throwable $th) {
            return redirect()->back()->with(
                'error', $th->getMessage()
            );
        }
    }
    function detail(Int $id) : object {
        try {
            $tiket = Ticket::find($id)->load('detail_tickets', 'detail_tickets.detail_products');
            $tiket->tanggal_dibuat = Carbon::parse($tiket->tanggal_dibuat)->translatedFormat('d F Y');
            $log = TicketLog::where('id_tiket', $id)->get();
            $teknisi = User::where('role', 'teknisi')->get();

            return view('test.admin.admin-tiket-detail', [
                'tiket' => $tiket,
                'log' => $log,
                'teknisi' => $teknisi
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with(
                'error', $th->getMessage()
            );
        }
    }
}
