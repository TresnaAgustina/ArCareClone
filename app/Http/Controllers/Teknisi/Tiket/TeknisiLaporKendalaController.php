<?php

namespace App\Http\Controllers\Teknisi\Tiket;

use App\Http\Controllers\Controller;
use App\Models\Assigment;
use App\Models\Ticket;
use App\Models\TicketLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class TeknisiLaporKendalaController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Int $id)
    {
        try {
            $data = $request->only('jenis_kendala', 'deskripsi', 'aksi_diambil');
            $tiket = Ticket::findOrFail($id);

            $validation = Validator::make($data, [
                'jenis_kendala' => ['required', 'in:1,2,3', 'numeric'], // 1 = Peralatan kurang, 2 = Perbaikan diluar garansi, 3 = Penggantian sparepart 
                'deskripsi' => ['nullable', 'string'],
                'aksi_diambil' => ['nullable', 'in:1,2,3', 'numeric'],

            ]);
            if ($validation->fails()) {
                return redirect()->back()->withErrors(
                    $validation->errors()
                );
            }

            DB::beginTransaction();
            TicketLog::create([
                'id_tiket' => $tiket->id,
                'dibuat_oleh' => Auth::user()->name,
                'konteks' => 'Lapor Kendala',
                'status' => 3, // dikerjakan
                'jenis_kendala' => $data['jenis_kendala'],
                'deskripsi' => $data['deskripsi'],
                'aksi_diambil' => $data['aksi_diambil'],
                'is_public' => false
            ]);
            $tiket->update([
                'status' => 3, // dikerjakan
                'kategori' => 8 // teknisi lapor kendala
            ]);
            $assign = Assigment::where('id_tiket', $id)->first();
            $assign->update([
                'status' => 2, // dikerjakan
            ]);
            DB::commit();

            return redirect()->back()->with(
                'success', 'Kendala berhasil dilaporkan'
            );

        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error('Error: ', ['error' => $th->getMessage()]);
            return redirect()->back()->withErrors(
                $th->getMessage()
            );
        }
    }
}
