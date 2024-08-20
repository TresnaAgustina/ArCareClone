<?php

namespace App\Http\Controllers\Admin\Akun;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AkunUpdateController extends Controller
{
    function index(Int $id) : object {
        try {
            $user = User::find($id);
            if (!$user) {
                return redirect()->back()->with(
                    'error', 'Akun tidak ditemukan'
                );
            }

            return view('admin.akun.edit', [
                'user' => $user,
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with(
                'error', $th->getMessage()
            );
        }
    }

    function update(Request $request, Int $id) : object {
        try {
            $data = $request->all();
            $user = User::find($id);
            if (!$user) {
                return redirect()->back()->with(
                    'error', 'Akun tidak ditemukan'
                );
            }

            $validate = Validator::make($data, [
                'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user->id), 'regex:/^[a-zA-Z0-9]+$/'],
                'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id), 'email:rfc,dns'],
                'password' => ['required', 'string', 'min: 8'],
                'role' => ['required', 'in:admin,manajer,teknisi,rekanan,pelanggan'],
                'nomor_telepon' => ['required', 'string', 'max:20', 'regex:/^[0-9]+$/', Rule::unique('users')->ignore($user->id)],
                'alamat' => ['required', 'string'],
            ]);

            if ($validate->fails()) {
                return redirect()->back()->with(
                    'error', $validate->errors()
                );
            }


            DB::beginTransaction();
            $user->update([
                'username' => $request->username,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => $request->role,
                'nomor_telepon' => $request->nomor_telepon,
                'alamat' => $request->alamat,
            ]);
            DB::commit();

            // return redirect()->route('admin.akun.index')->with(
            //     'success', 'Berhasil mengubah akun'
            // );

            return response()->json([
                'status' => 'success',
                'message' => 'Berhasil mengubah akun',
                'data' => $user,
            ], 200);

        } catch (\Throwable $th) {
            return redirect()->back()->with(
                'error', $th->getMessage()
            );
        }
    }
}
