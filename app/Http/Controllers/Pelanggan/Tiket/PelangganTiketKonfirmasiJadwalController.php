<?php

namespace App\Http\Controllers\Pelanggan\Tiket;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\TicketLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PelangganTiketKonfirmasiJadwalController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Int $id)
    {
        try {
            $data = $request->only('persetujuan', 'alasan');
            $tiket = Ticket::find($id);
            if (!$tiket) {
                return redirect()->back()->withErrors(
                    'Tiket tidak ditemukan'
                );
            }

            $validation = Validator::make($data, [
                'persetujuan' => 'required|boolean',
                'alasan' => 'required|string'
            ]);

            if ($validation->fails()) {
                return redirect()->back()->withErrors(
                    $validation->errors()
                );
            }

            // == *** LOGIC HERE *** == //
            DB::beginTransaction();
            if ($data['persetujuan'] == 1) {
                TicketLog::create([
                    'id_tiket' => $tiket->id,
                    'dibuat_oleh' => Auth::user()->name,
                    'konteks' => 'Jadwal Disetujui, Menunggu Penugasan',
                    'status' => 2, // penugasan
                    'tanggal_jadwal' => null,
                    'deskripsi' => Auth::user()->name . ' telah menyetujui jadwal parbaikan'
                ]);
                $tiket->update([
                    'status' => 2, // penugasan
                    'kategori' => 3 // pelanggan konfirmasi setuju
                ]);
            }else{
                TicketLog::create([
                    'id_tiket' => $tiket->id,
                    'dibuat_oleh' => Auth::user()->name,
                    'konteks' => 'Jadwal Ditolak',
                    'status' => 1, // penugasan
                    'tanggal_jadwal' => null,
                    'deskripsi' => $data['alasan']
                ]);
                $tiket->update([
                    'tanggal_perbaikan' => null,
                    'status' => 1, // penugasan
                    'kategori' => 4 // pelanggan konfirmasi tidak setuju
                ]);
            }
            DB::commit();

            return redirect()->back()->with(
                'success', 'Konfirmasi jadwal berhasil'
            );

        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(
                $th->getMessage()
            );
        }
    }
}
