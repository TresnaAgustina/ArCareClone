<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    function index() : object {
        try {
            return view('pages.auth.login');
        } catch (\Throwable $th) {
            return redirect()->back()->with(
                'error', $th->getMessage()
            );
        }
    }

    function login(LoginRequest $request): object {
        try {
            // Validasi input
            $validated = $request->validated();
            
            // Ambil data kredensial (username dan password)
            $credentials = $request->only('username', 'password');
            
            // Log untuk memeriksa kredensial yang diambil
            Log::info('Login attempt with credentials:', $credentials);
            
            // Coba login menggunakan kredensial
            if (Auth::attempt($credentials)) {
                // Regenerasi session untuk menghindari session fixation
                $request->session()->regenerate();
                
                // Log user info
                Log::info('User authenticated:', ['user_id' => Auth::id(), 'role' => Auth::user()->role]);
    
                // Redirect berdasarkan role user
                switch (Auth::user()->role) {
                    case 'admin':
                        return redirect()->route('admin.tiket.index');
                    case 'manajer':
                        return redirect()->route('manajer.dashboard');
                    case 'teknisi':
                        return redirect()->route('teknisi.tiket.index');
                    case 'rekanan':
                        return redirect()->route('rekanan.dashboard');
                    case 'pelanggan':
                        return redirect()->route('pelanggan.dashboard');
                    default:
                        // Log jika user tidak memiliki role yang diizinkan
                        Log::error('Unauthorized access attempt:', ['user_id' => Auth::id()]);
                        return redirect()->route('login')->with('error', 'Anda tidak memiliki hak akses');
                }
            }
    
            // Jika Auth::attempt gagal
            Log::error('Failed login attempt: Invalid credentials', $credentials);
            return redirect()->back()->with('error', 'Username atau Password salah');
    
        } catch (\Throwable $th) {
            // Log error detail untuk debugging
            Log::error('An error occurred during login', ['exception' => $th]);
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }
    
}
