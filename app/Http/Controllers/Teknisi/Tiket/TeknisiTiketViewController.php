<?php

namespace App\Http\Controllers\Teknisi\Tiket;

use App\Http\Controllers\Controller;
use App\Models\Assigment;
use App\Models\Ticket;
use App\Models\TicketLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeknisiTiketViewController extends Controller
{
    function index() : object {
        try {
            $teknisi = Auth::user();
            $assign = Assigment::where('id_teknisi', $teknisi->id)->get();
            $tiket = Ticket::whereIn('id', $assign->pluck('id_tiket'))->get();
            
            return view('test.teknisi.teknisi-tiket-index', [
                'tiket' => $tiket,
                'assign' => $assign
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(
                $th->getMessage()
            );
        }
    }

    function detail(Int $id) : object {
        try {
            $tiket = Ticket::findOrFail($id)->load('detail_tickets', 'detail_tickets.detail_products');
            $tiket->tanggal_dibuat = Carbon::parse($tiket->tanggal_dibuat)->translatedFormat('d F Y');
            $log = TicketLog::where('id_tiket', $id)->get();
            
            return view('test.teknisi.teknisi-tiket-detail', [
                'tiket' => $tiket,
                'log' => $log
            ]);

        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(
                $th->getMessage()
            );
        }
    }
}
