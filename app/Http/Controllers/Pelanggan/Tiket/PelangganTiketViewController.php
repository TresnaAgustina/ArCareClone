<?php

namespace App\Http\Controllers\Pelanggan\Tiket;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\TicketLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PelangganTiketViewController extends Controller
{
    // View Tiket All
    function index() : object {
        try {
            $tiket = Ticket::where('id_pelanggan', Auth::user()->id)->orderBy('created_at', 'desc')->get();
            foreach ($tiket as $t) {
                $t->tanggal_dibuat = Carbon::parse($t->tanggal_dibuat)->translatedFormat('d F Y');
            }

            return  view('pages.user.ticket.view.view_ticket_user', [
                'tiket' => $tiket
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with(
                'error', $th->getMessage()
            );
        }
    }
    // View Tiket Masuk
    function masuk() : object {
        try {
            $tiket = Ticket::where([
                ['id_pelanggan', '=', Auth::user()->id],
                ['status', '=', 'menunggu']
            ])->orderBy('created_at', 'desc')->get();
            foreach ($tiket as $t) {
                $t->tanggal_dibuat = Carbon::parse($t->tanggal_dibuat)->translatedFormat('d F Y');
            }

            return  view('pages.user.ticket.view.masuk', [
                'tiket' => $tiket
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with(
                'error', $th->getMessage()
            );
        }
    }
    // View Tiket Aktif/Dikerjakan
    function aktif() : object {
        try {
            $tiket = Ticket::where([
                ['id_pelanggan', '=', Auth::user()->id],
                ['status', '=', 'dikerjakan']
                ])->orderBy('created_at', 'desc')->get();
            foreach ($tiket as $t) {
                $t->tanggal_dibuat = Carbon::parse($t->tanggal_dibuat)->translatedFormat('d F Y');
            }
            
            return  view('pages.user.ticket.view.aktif', [
                'tiket' => $tiket
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with(
                'error', $th->getMessage()
            );
        }
    }
    // View Tiket Pending
    function pending() : object {
        try {
            $tiket = Ticket::where([
                ['id_pelanggan', '=', Auth::user()->id],
                ['status', '=', 'pending']
            ])->orderBy('created_at', 'desc')->get();
            foreach ($tiket as $t) {
                $t->tanggal_dibuat = Carbon::parse($t->tanggal_dibuat)->translatedFormat('d F Y');
            }

            return  view('pages.user.ticket.view.pending', [
                'tiket' => $tiket
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with(
                'error', $th->getMessage()
            );
        }
    }
    // View Tiket Selesai
    function selesai() : object {
        try {
            $tiket = Ticket::where([
                ['id_pelanggan', '=', Auth::user()->id],
                ['status', '=', 'selesai']
            ])->orderBy('created_at', 'desc')->get();
            foreach ($tiket as $t) {
                $t->tanggal_dibuat = Carbon::parse($t->tanggal_dibuat)->translatedFormat('d F Y');
            }

            return  view('pages.user.ticket.view.selesai', [
                'tiket' => $tiket
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with(
                'error', $th->getMessage()
            );
        }
    }
    // View Tiket Dibatalkan
    function dibatalkan() : object {
        try {
            $tiket = Ticket::where([
                ['id_pelanggan', '=', Auth::user()->id],
                ['status', '=', 'dibatalkan']
            ])->orderBy('created_at', 'desc')->get();
            foreach ($tiket as $t) {
                $t->tanggal_dibuat = Carbon::parse($t->tanggal_dibuat)->translatedFormat('d F Y');
            }

            return  view('pages.user.ticket.view.batal', [
                'tiket' => $tiket
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with(
                'error', $th->getMessage()
            );
        }
    }

    // View Buat Tiket Baru
    function new() : object {
        try {
            return view('pages.user.ticket.add_ticket');
        } catch (\Throwable $th) {
            return redirect()->back()->with(
                'error', $th->getMessage()
            );
        }
    }

    // View Detail Tiket
    function detail($id) : object {
        try {
            $tiket = Ticket::find($id)->load('detail_tickets', 'detail_tickets.detail_products');
            $tiket->tanggal_dibuat = Carbon::parse($tiket->tanggal_dibuat)->translatedFormat('d F Y');
            $log = TicketLog::where('id_tiket', $id)->where('is_public', true)->get();

            return view('test.pelanggan.pelanggan-tiket-detail', [
                'tiket' => $tiket,
                'log' => $log
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with(
                'error', $th->getMessage()
            );
        }
    }
}
