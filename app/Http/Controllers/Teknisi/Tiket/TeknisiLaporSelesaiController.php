<?php

namespace App\Http\Controllers\Teknisi\Tiket;

use App\Http\Controllers\Controller;
use App\Models\Assigment;
use App\Models\Ticket;
use App\Models\TicketLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TeknisiLaporSelesaiController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Int $id)
    {
        try {
            $data = $request->only('atribut1', 'atribut2');
            $tiket = Ticket::findOrFail($id);

            $validation = Validator::make($data, [
                // Logic Here
            ]);
            if ($validation->fails()) {
                return redirect()->back()->withErrors(
                    $validation->errors()
                );
            }

            DB::beginTransaction();
            $log = TicketLog::create([
                // Logic Here
            ]);
            $tiket->update([
                // Logic Here
            ]);

            $assign = Assigment::where('id_tiket', $id)->first();
            $assign->update([
                // Logic Here
            ]);
            DB::commit();

            return redirect()->back()->with(
                'success', 'Tiket berhasil diselesaikan'
            );
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(
                $th->getMessage()
            );
        }
    }
}
