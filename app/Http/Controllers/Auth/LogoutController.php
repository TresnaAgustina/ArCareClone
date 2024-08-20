<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        try {
            Auth::user()->tokens->each(function ($token) {
                $token->delete();
            });
    
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            // return redirect()->route('login')->with(
            //     'success', 'Logout berhasil'
            // );
            return response()->json([
                'status' => 'success',
                'message' => 'Logout berhasil',
                'status' => 200
            ]);
        } catch (\Throwable $th) {
            // return redirect()->back()->with(
            //     'error', $th->getMessage()
            // );
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage(),
                'status' => 500
            ]);
        }
    }
}
