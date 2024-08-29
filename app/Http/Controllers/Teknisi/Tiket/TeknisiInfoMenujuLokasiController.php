<?php

namespace App\Http\Controllers\Teknisi\Tiket;

use App\Models\Ticket;
use App\Models\TicketLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Assigment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TeknisiInfoMenujuLokasiController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Int $id)
    {
        try {
            $data = $request->only('info');
            $tiket = Ticket::findOrFail($id);

            $validation = Validator::make($data, [
                'info' => ['required', 'in:on,off'], // 0 = Tidak Setuju, 1 = Setuju
            ]);

            if ($validation->fails()) {
                return redirect()->back()->withErrors(
                    $validation->errors()
                );
            }

            DB::beginTransaction();
            $assign = Assigment::where('id_tiket', $tiket->id)->first();
            $assign->update([
                'status' => 2, // dikerjakan
            ]);
            $log = TicketLog::create([
                'id_tiket' => $tiket->id,
                'dibuat_oleh' => Auth::user()->name,
                'konteks' => 'Teknisi Menuju Lokasi',
                'status' => 3, // dikerjakan
                'deskripsi' => 'Teknisi ('.Auth::user()->name.') Menuju Lokasi',
            ]);
            $tiket->update([
                'status' => 3, // dikerjakan
                'kategori' => 7 // teknisi menuju lokasi
            ]);
            DB::commit();

            if (!$assign || !$log) {
                return redirect()->back()->withErrors(
                    'Gagal Mengirim Konfirmasi'
                );
            }


            return redirect()->back()->with(
                'success', 'Konfirmasi Berhasil Terkirim'
            );

        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(
                $th->getMessage()
            );
        }
    }
}
