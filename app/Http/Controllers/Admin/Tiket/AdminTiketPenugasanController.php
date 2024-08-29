<?php

namespace App\Http\Controllers\Admin\Tiket;

use App\Http\Controllers\Controller;
use App\Models\Assigment;
use App\Models\Ticket;
use App\Models\TicketLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminTiketPenugasanController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Int $id)
    {
        try {
            $data = $request->only('id_teknisi', 'deskripsi', 'tanggal_perbaikan');
            $tiket = Ticket::find($id);
            if (!$tiket) {
                return redirect()->back()->withErrors(
                    'Tiket tidak ditemukan'
                );
            }
            $teknisi = User::find($data['id_teknisi']);
            if (!$teknisi) {
                return redirect()->back()->withErrors(
                    'Teknisi tidak ditemukan'
                );
            }

            // == *** LOGIC HERE *** == //
            DB::beginTransaction();
            $assigment = Assigment::updateOrCreate(
                ['id_tiket' => $tiket->id],
                [
                    'id_teknisi' => $teknisi->id,
                    'nama_teknisi' => $teknisi->name,
                    'tanggal_perbaikan' => $tiket->tanggal_perbaikan,
                    'status' => 1, // menunggu
                ]
            );

            $log = TicketLog::create([
                'id_tiket' => $tiket->id,
                'dibuat_oleh' => Auth::user()->name,
                'konteks' => 'Penugasan Teknisi',
                'status' => 2, // dikerjakan
                'tanggal_jadwal' => $data['tanggal_perbaikan'],
                'deskripsi' => $data['deskripsi']
            ]);

            $tiket->update([
                'status' => 2, // penugasan
                'kategori' => 5 // admin memberi tugas
            ]);
            DB::commit();

            if (!$assigment || !$log) {
                return redirect()->back()->withErrors(
                    'Gagal melakukan penugasan'
                );
            }

            return redirect()->back()->with(
                'success', 'Penugasan berhasil'
            );

        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(
                $th->getMessage()
            );
        }
    }
}
