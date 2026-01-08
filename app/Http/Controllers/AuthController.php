<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\LevelModel;
use App\Models\UserModel;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::check()) { 
            return redirect('/');
        }
        return view('auth.login');
    }
    public function postLogin(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $credentials = $request->only('username', 'password');
            if (Auth::attempt($credentials)) {
                return response()->json([
                    'status' => true,
                    'message' => 'Login Berhasil',
                    'redirect' => url('/')

                ]);
            }
            return response()->json([
                'status' => false,
                'message' => 'Login Gagal'
            ]);
        }
        return redirect('login');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');
    }

    public function register()
    {
        // Kita ambil data level agar user bisa memilih role (atau bisa di-hardcode)
        $level = LevelModel::all();
        return view('auth.register', ['level' => $level]);
    }

    public function postRegister(Request $request)
    {
        $request->validate([
            'username' => 'required|min:4|unique:m_user,username',
            'nama'     => 'required|max:100',
            'password' => 'required|min:5|confirmed', // field konfirmasi password harus bernama password_confirmation
            'level_id' => 'required|integer'
        ]);

        UserModel::create([
            'username' => $request->username,
            'nama'     => $request->nama,
            'password' => Hash::make($request->password), // Jangan lupa di-hash
            'level_id' => $request->level_id,
        ]);

        return redirect('login')->with('success', 'Registrasi berhasil. Silakan login.');
    }
}
