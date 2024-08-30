<?php

namespace App\Http\Controllers\Pelanggan\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PelangganDashboardController extends Controller
{
    function home() {
        try {
            //code...
            
            // $ticket = Ticket::where([
            //     ['id_pelanggan', Auth::user()->id],
            // ])->orderBy('created_at', 'desc')->get();
            // foreach ($ticket as $t) {
            //     $t->tanggal_dibuat = Carbon::parse($t->tanggal_dibuat)->translatedFormat('d F Y');
            // }
            
            return view('pages.user.dashboard');
        } catch (\Throwable $th) {
            return redirect()->back()->with(
                'error', $th->getMessage()
            );
        }
    }
}
