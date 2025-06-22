<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Http;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input + CAPTCHA
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
            'g-recaptcha-response' => 'required' // Validasi reCAPTCHA
        ]);

        // Verifikasi CAPTCHA ke server Google
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => env('NOCAPTCHA_SECRET'),
            'response' => $request->input('g-recaptcha-response'),
        ]);

        // Jika CAPTCHA gagal diverifikasi
        if (! $response->json('success')) {
            return back()->withErrors([
                'g-recaptcha-response' => 'Verifikasi CAPTCHA gagal. Silakan coba lagi.'
            ])->withInput();
        }

        // Simpan ke database jika CAPTCHA valid
        Contact::create($validated);

        return back()->with('success', 'Pesan Anda telah terkirim! Terima kasih telah menghubungi kami.');
    }
}
