<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClientLogo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClientLogoController extends Controller
{
    public function index()
    {
        $clients = ClientLogo::ordered()->get();
        return view('admin.cms.clients.index', compact('clients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:100',
            'logo'      => 'required|image|mimes:jpg,jpeg,png,webp,svg|max:1024',
            'website'   => 'nullable|url',
            'order'     => 'nullable|integer',
        ]);

        $path = $request->file('logo')->store('clients', 'public');

        ClientLogo::create([
            'name'      => $request->name,
            'logo'      => $path,
            'website'   => $request->website,
            'order'     => $request->order ?? 0,
            'is_active' => true,
        ]);

        return redirect()->route('admin.cms.clients.index')
            ->with('success', 'Logo klien berhasil ditambahkan!');
    }

    public function destroy(ClientLogo $client)
    {
        if (Storage::disk('public')->exists($client->logo)) {
            Storage::disk('public')->delete($client->logo);
        }
        $client->delete();

        return redirect()->route('admin.cms.clients.index')
            ->with('success', 'Logo berhasil dihapus.');
    }

    public function toggleActive(ClientLogo $client)
    {
        $client->update(['is_active' => ! $client->is_active]);
        return redirect()->route('admin.cms.clients.index')
            ->with('success', 'Status logo diperbarui.');
    }
}