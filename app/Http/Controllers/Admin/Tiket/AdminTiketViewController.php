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
    // live controller
    function index() : object {
        try {
            $tiket = Ticket::all();
            return view('pages.admin.tiket.view_ticket_user', [
                'tiket' => $tiket
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with(
                'error', $th->getMessage()
            );
        }
    }

    // // test ticketing
    // function index() : object {
    //     try {
    //         $tiket = Ticket::all();
    //         return view('test.admin.admin-tiket-index', [
    //             'tiket' => $tiket
    //         ]);
    //     } catch (\Throwable $th) {
    //         return redirect()->back()->with(
    //             'error', $th->getMessage()
    //         );
    //     }
    // }
    function detail(Int $id) : object {
        try {
            $tiket = Ticket::find($id)->load('detail_tickets', 'detail_tickets.detail_products');
            $tiket->tanggal_dibuat = Carbon::parse($tiket->tanggal_dibuat)->translatedFormat('d F Y');
            $log = TicketLog::where('id_tiket', $id)->get();
            $teknisi = User::where('role', 'teknisi')->get();
            $kendala = TicketLog::where('id_tiket', $id)
              ->orderBy('created_at', 'desc')
              ->first();


            return view('test.admin.admin-tiket-detail', [
                'tiket' => $tiket,
                'log' => $log,
                'teknisi' => $teknisi,
                'kendala' => $kendala
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with(
                'error', $th->getMessage()
            );
        }
    }
}
