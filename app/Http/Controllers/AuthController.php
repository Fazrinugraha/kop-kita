<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{

    public function index()
    {
        $dataview = new \stdClass();
        $dataview->title = 'Login | ' . getTitle();
        return view('pages/admin/login', compact('dataview'));
    }

    public function buat_hash()
    {
        $hash = Hash::make('12345');
        return dd($hash);
    }

    public function login(Request $request)
    {

        // Validasi manual CAPTCHA terlebih dahulu
        $request->validate([
            'g-recaptcha-response' => 'required'
        ], [
            'g-recaptcha-response.required' => 'Verifikasi CAPTCHA wajib diisi.'
        ]);

        // Kirim ke server Google untuk validasi
        $recaptcha = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => env('NOCAPTCHA_SECRET'),
            'response' => $request->input('g-recaptcha-response'),
        ]);

        if (! $recaptcha->json('success')) {
            return redirect()->back()
                ->withErrors(['g-recaptcha-response' => 'Verifikasi CAPTCHA gagal. Silakan coba lagi.'])
                ->withInput();
        }

        $username = $request->username;
        $password = $request->password;

        if (empty($username) && empty($password)) {
            return redirect()->back()->with('failed', 'Maaf, username dan password tidak boleh kosong.');
        } else {
            $pengguna = DB::table('profil_kop_admin_web')->where('username', $username)->first();
            // kalau data pengguna tidak ada,
            if (!$pengguna) {
                return redirect()->back()->with('failed', 'Username atau password salah.<br>Periksa kembali username atau password anda.')->withInput();
            } else {
                // kalau pengguna sudah ada terdaftar,
                if (!Hash::check($password, $pengguna->password)) {
                    return redirect()->back()->with('failed', 'Username atau password salah.')->withInput();
                }

                // cek status siswa
                // if($pengguna->status_akun=='W'){
                //     return redirect()->back()->with('warning', 'Akun anda belum aktif.')->withInput();
                // }
                // elseif($pengguna->status_akun=='A'){
                //     // login
                //     Auth::guard('admin')->LoginUsingId($pengguna->id_admin_web);
                //     return redirect('/dashboard');
                // }
                // login
                Auth::guard('admin')->LoginUsingId($pengguna->id_admin_web);
                return redirect('/dashboard');
            }
        }
    }

    public function logout()
    {
        session()->invalidate();
        return redirect('/login')->with('success', 'Anda telah keluar dari sistem');
    }

    public function ganti_password(Request $request)
    {
        $guards = ['admin'];

        foreach ($guards as $guard) {
            $user = Auth::guard($guard)->user();

            if ($user) {
                $oldPassword = $request->old_password;
                $newPassword = $request->new_password;

                // Periksa apakah password lama sesuai dengan password pengguna
                if (Hash::check($oldPassword, $user->password)) {
                    // Jika sesuai, update password pengguna dengan password baru
                    $user->password = Hash::make($newPassword);
                    $user->save();

                    return redirect()->back()->with('success', 'Password berhasil diubah.');
                } else {
                    // Jika password lama tidak sesuai, kembalikan dengan pesan error
                    return redirect()->back()->with('failed', 'Password lama tidak sesuai.');
                }
            }
        }

        return redirect()->back()->with('failed', 'User tidak ditemukan. Silakan login kembali.');
    }
}
