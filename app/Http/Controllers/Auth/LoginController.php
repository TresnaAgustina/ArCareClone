<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    function index() : object {
        try {
            return view('auth.login');
        } catch (\Throwable $th) {
            return redirect()->back()->with(
                'error', $th->getMessage()
            );
        }
    }

    function login(LoginRequest $request) : object {
        try {
            $request->validated();
            $credentials = $request->only('username', 'password');
            if (Auth::attempt($credentials)) {
                if (Auth::user()->role === 'admin') {
                    $request->session()->regenerate();
                    // return redirect()->route('admin.dashboard');
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Login berhasil',
                        'data' => Auth::user(),
                        'role' => Auth::user()->role,
                        'status' => 200
                    ]);
                }else if(Auth::user()->role === 'manajer'){
                    // create session
                    $request->session()->regenerate();

                    // return redirect()->route('manajer.dashboard');
                    return response([
                        'status' => 'success',
                        'message' => 'Login berhasil',
                        'data' => Auth::user(),
                        'role' => Auth::user()->role,
                        'status' => 200
                    ]);
                }else if(Auth::user()->role === 'teknisi'){
                    $request->session()->regenerate();
                    // return redirect()->route('teknisi.dashboard');
                    return response([
                        'status' => 'success',
                        'message' => 'Login berhasil',
                        'data' => Auth::user(),
                        'role' => Auth::user()->role,
                        'status' => 200
                    ]);
                }else if (Auth::user()->role === 'rekanan') {
                    $request->session()->regenerate();
                    // return redirect()->route('rekanan.dashboard');
                    return response([
                        'status' => 'success',
                        'message' => 'Login berhasil',
                        'data' => Auth::user(),
                        'role' => Auth::user()->role,
                        'status' => 200
                    ]);
                }else if (Auth::user()->role === 'pelanggan') {
                    $request->session()->regenerate();
                    // return redirect()->route('pelanggan.dashboard');
                    return response([
                        'status' => 'success',
                        'message' => 'Login berhasil',
                        'data' => Auth::user(),
                        'role' => Auth::user()->role,
                        'status' => 200
                    ]);
                }else{
                    // return redirect()->route('login')->with(
                    //     'error', 'Anda tidak memiliki hak akses'
                    // );
                    return response([
                        'status' => 'error',
                        'message' => 'Anda tidak memiliki hak akses',
                        'status' => 403
                    ]);
                }
            }

            return redirect()->back()->with(
                'error', 'Username atau Password salah'
            );
        } catch (\Throwable $th) {
            return redirect()->back()->with(
                'error', $th->getMessage()
            );
        }
    }
}
