<?php

namespace App\Http\Controllers\Pelanggan\Tiket;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PelangganKelolaTiketController extends Controller
{
    // View Tiket All
    function index() : object {
        try {
            //code...
        } catch (\Throwable $th) {
            return redirect()->back()->with(
                'error', $th->getMessage()
            );
        }
    }
    // View Tiket Masuk
    function masuk() : object {
        try {
            //code...
        } catch (\Throwable $th) {
            return redirect()->back()->with(
                'error', $th->getMessage()
            );
        }
    }
    // View Tiket Aktif/Dikerjakan
    function aktif() : object {
        try {
            //code...
        } catch (\Throwable $th) {
            return redirect()->back()->with(
                'error', $th->getMessage()
            );
        }
    }
    // View Tiket Pending
    function pending() : object {
        try {
            //code...
        } catch (\Throwable $th) {
            return redirect()->back()->with(
                'error', $th->getMessage()
            );
        }
    }
    // View Tiket Dibatalkan
    function selesai() : object {
        try {
            //code...
        } catch (\Throwable $th) {
            return redirect()->back()->with(
                'error', $th->getMessage()
            );
        }
    }

    // View Buat Tiket Baru
    function new() : object {
        try {
            //code...
        } catch (\Throwable $th) {
            return redirect()->back()->with(
                'error', $th->getMessage()
            );
        }
    }

    // View Detail Tiket
    function detail($id) : object {
        try {
            //code...
        } catch (\Throwable $th) {
            return redirect()->back()->with(
                'error', $th->getMessage()
            );
        }
    }

    // *** === *** POST LOGIC *** === *** //

    // Pelanggan Konfirmasi Jadwal
    function konfirmasi_jadwal(Request $request, Int $id) : object {
        try {
            $data = $request->only('persetujuan', 'alasan');
            $tiket = Ticket::find($id);

            if (!$tiket) {
                return redirect()->back()->with(
                    'error', 'Tiket tidak ditemukan'
                );
            }

            $validation = Validator::make($data, [
                'persetujuan' => 'required|in:setuju,tolak',
                'alasan' => 'nullable|string',
            ]);

            if ($validation->fails()) {
                return redirect()->back()->with(
                    'error', $validation->errors()->first()
                );
            }

            DB::beginTransaction();
            if ($data['persetujuan'] == 'setuju') {
                $tiket->update([
                    'status' => 2,
                ]);
            } else {
                $tiket->update([
                    'status' => 3,
                    'alasan' => $data['alasan'],
                ]);
            }
            DB::commit();

            return redirect()->back()->with(
                'success', 'Konfirmasi jadwal berhasil'
            );

        } catch (\Throwable $th) {
            return redirect()->back()->with(
                'error', $th->getMessage()
            );
        }
    }

    // Pelanggan Konfirmasi Kendala
    function konfirmasi_kendala(Request $request) : object {
        try {
            //code...
        } catch (\Throwable $th) {
            return redirect()->back()->with(
                'error', $th->getMessage()
            );
        }
    }
}
