<?php

namespace App\Http\Controllers;

use App\Models\ContactSubmission;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'whatsapp' => 'required|string|max:20',
            'email'    => 'nullable|email|max:255',
            'service'  => 'nullable|string|max:255',
            'message'  => 'required|string|max:5000',
        ], [
            'name.required'     => 'Nama lengkap wajib diisi.',
            'whatsapp.required' => 'Nomor WhatsApp wajib diisi.',
            'message.required'  => 'Detail kebutuhan wajib diisi.',
            'email.email'       => 'Format email tidak valid.',
        ]);

        $validated['ip_address'] = $request->ip();

        ContactSubmission::create($validated);

        return redirect()->back()->with('success', 'Pesan Anda berhasil dikirim! Tim kami akan segera menghubungi Anda.');
    }
}