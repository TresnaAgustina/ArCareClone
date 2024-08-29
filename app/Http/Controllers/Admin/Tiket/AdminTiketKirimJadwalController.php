<?php

namespace App\Http\Controllers\Admin\Tiket;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\TicketLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AdminTiketKirimJadwalController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Int $id)
    {
        try {
            $data = $request->only('tanggal', 'keterangan');
            $tiket = Ticket::find($id);

            if (!$tiket) {
                return redirect()->back()->withErrors(
                    'Tiket tidak ditemukan'
                );
            }

            $validation = Validator::make($data, [
                'tanggal' => 'required|date',
                'keterangan' => 'nullable|string'
            ]);

            if ($validation->fails()) {
                return redirect()->back()->withErrors(
                    $validation->errors()
                );
            }

            // == *** LOGIC HERE *** == //
            DB::beginTransaction();
            TicketLog::create([
                'id_tiket' => $tiket->id,
                'dibuat_oleh' => Auth::user()->name,
                'konteks' => 'Penentuan Jadwal Perbaikan',
                'status' => 1, // menunggu
                'tanggal_jadwal' => $data['tanggal'],
                'deskripsi' => $data['keterangan']
            ]);

            $tiket->update([
                'tanggal_perbaikan' => $data['tanggal'],
                'status' => 1, // menunggu
                'kategori' => 2 // admin memberi jadwal
            ]);
            DB::commit();

            return redirect()->back()->with(
                'success', 'Jadwal berhasil dikirim'
            );
            
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors(
                $th->getMessage()
            );
        }
    }
}
