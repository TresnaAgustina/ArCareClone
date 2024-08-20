<?php

namespace App\Http\Controllers\Pelanggan\Tiket;

use App\Http\Controllers\Controller;
use App\Http\Requests\TiketRequest;
use App\Models\Ticket;
use App\Models\TicketDetailLocation;
use App\Models\TicketDetailProduct;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TiketCreateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(TiketRequest $request)
    {
        try {
            dd($request->all());
            // *** === Validasi Data === *** //
            $request->validated();
            $pelanggan = User::find($request->id_pelanggan);
            if (!$pelanggan) {
                return redirect()->back()->with('error', 'Pelanggan tidak ditemukan');
            }

            // *** === Data Generate === *** //
            $kodeTiket = ticket_code();
            $nama_pelanggan = $pelanggan->name;
            // $tanggal_dibuat = Carbon::parse($request->tanggal_dibuat)->format('d F Y');

            // *** === Store Data === *** //
            DB::beginTransaction();
            $store = Ticket::create([
                'kode_tiket' => $kodeTiket,
                'id_pelanggan' => $request->id_pelanggan,
                'nama_pelanggan' => $nama_pelanggan,
                'tanggal_dibuat' => $request->tanggal_dibuat,
                'tanggal_selesai' => null,
                'nama_pic_fakultas' => $request->nama_pic_fakultas,
                'telepon_pic_fakultas' => $request->telepon_pic_fakultas,
                'nama_pic_ruangan' => $request->nama_pic_ruangan,
                'telepon_pic_ruangan' => $request->telepon_pic_ruangan,
                'keterangan' => $request->keterangan,
                'status' => 1,
            ]);

            foreach ($request->detail_tickets as $item) {
                $detail = TicketDetailLocation::create([
                    'id_tiket' => $store->id,
                    'lokasi' => $item['lokasi'],
                    'alamat' => $item['alamat'],
                ]);
                // insert to detail product
                foreach ($item['detail_products'] as $value) {
                    $product = TicketDetailProduct::create([
                        'id_lokasi' => $detail->id,
                        'merk_produk' => $value['merk_produk'],
                        'permasalahan' => $value['permasalahan'],
                    ]);
                }
            }
            DB::commit();

            return redirect()->back()->with('success', 'Tiket berhasil dibuat');
            // return response()->json([
            //     'message' => 'Tiket berhasil dibuat',
            //     'data' => [
            //         'data_tiket' => $store->load('detail_tickets', 'detail_tickets.detail_products'),
            //     ],
            // ], 201);
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Tiket gagal dibuat');
            // return response()->json([
            //     'message' => 'Tiket gagal dibuat',
            //     'error' => $th->getMessage(),
            // ], 500);
        }
    }
}
