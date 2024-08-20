<?php

namespace App\Http\Controllers\Admin\Akun;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AkunDeleteController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Int $id)
    {
        try {
            $user = User::find($id);
            if (!$user) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Akun tidak ditemukan',
                    'data' => null,
                ], 400);
            }

            DB::beginTransaction();
            $delete = $user->delete();
            DB::commit();
            if (!$delete) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Gagal menghapus akun',
                    'data' => null,
                ], 400);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Berhasil menghapus akun',
                'data' => $delete,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage(),
                'data' => null,
            ], 400);
        }
    }
}
