<?php

namespace App\Http\Controllers\Admin\Akun;

use App\Http\Controllers\Controller;
use App\Http\Requests\AkunRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AkunCreateController extends Controller
{
    function index() : object {
        try {
            $user = User::all();
            return view('admin.akun.index', [
                'user' => $user,
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with(
                'error', $th->getMessage()
            );
        }
    }

    function create() : object {
        try {
            return view('admin.akun.create');
        } catch (\Throwable $th) {
            return redirect()->back()->with(
                'error', $th->getMessage()
            );
        }
    }

    function store(AkunRequest $request) : object {
        try {
            $request->validated();

            DB::beginTransaction();
            $store = User::create([
                'username' => $request->username,
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => $request->role,
                'nomor_telepon' => $request->nomor_telepon,
                'alamat' => $request->alamat,
            ]);
            DB::commit();

            if (!$store) {
                return redirect()->back()->with(
                    'error', 'Gagal menambahkan akun'
                );
            }

            // return redirect()->route('admin.akun.index')->with(
            //     'success', 'Berhasil menambahkan akun'
            // );
            return response()->json([
                'status' => 'success',
                'message' => 'Berhasil menambahkan akun',
                'data' => $store,
            ], 200);

        } catch (\Throwable $th) {
            // return redirect()->back()->with(
            //     'error', $th->getMessage()
            // );

            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menambahkan akun',
                'error' => $th->getMessage(),
            ], 500);
        }
    }
}
