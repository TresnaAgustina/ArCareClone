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
            // *** === Validasi Data === *** //
            $request->validated();
            $pelanggan = User::find($request->id_pelanggan);
            if (!$pelanggan) {
                return response()->json([
                    'message' => 'ID Pelanggan tidak ditemukan',
                ], 404);
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

            foreach ($request->detail as $item) {
                $detail = TicketDetailLocation::create([
                    'id_tiket' => $store->id,
                    'lokasi' => $item['lokasi'],
                    'alamat' => $item['alamat'],
                ]);
                // insert to detail product
                foreach ($item['product'] as $value) {
                    $product = TicketDetailProduct::create([
                        'id_lokasi' => $detail->id,
                        'merk_produk' => $value['merk_produk'],
                        'permasalahan' => $value['permasalahan'],
                    ]);
                }
            }
            DB::commit();

            return response()->json([
                'message' => 'Tiket berhasil dibuat',
                'data' => [
                    'data_tiket' => $store->load('detail_tickets', 'detail_tickets.detail_products'),
                ],
            ], 201);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message' => 'Tiket gagal dibuat',
                'error' => $th->getMessage(),
            ], 500);
        }
    }
}
