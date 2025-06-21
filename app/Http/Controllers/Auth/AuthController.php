<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin;

class AuthController extends Controller
{
    // Tampilkan form login admin
    public function showLoginForm()
    {
        return view('auth.admin.login');
    }

    // Proses login admin
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email:dns',
            'password' => 'required|min:8|max:15',
        ]);

        if ($validator->fails()) {
            Alert::error('Error', 'Pastikan email dan password terisi dengan benar!');
            return redirect()->back()->withInput();
        }

        $attempt = Auth::guard('admin')->attempt([
            'email' => $request->email,
            'password' => $request->password
        ]);

        // dd($attempt, Auth::guard('admin')->user(), $request->email, $request->password);  // Debug output

        if ($attempt) {
            toast('Selamat datang admin!', 'success');
            return redirect()->route('admin.dashboard');
        }

        Alert::error('Login Gagal!', 'Email atau password salah!');
        return redirect()->back()->withInput();
    }


    // Logout admin
    public function logout()
    {
        Auth::guard('admin')->logout();
        toast('Berhasil logout!', 'success');
        return redirect()->route('login');
    }
}
