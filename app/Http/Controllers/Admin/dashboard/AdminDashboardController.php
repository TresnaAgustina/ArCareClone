<?php

namespace App\Http\Controllers\Admin\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
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
            
            return view('pages.admin.dashboard');
        } catch (\Throwable $th) {
            return redirect()->back()->with(
                'error', $th->getMessage()
            );
        }
    }
}
