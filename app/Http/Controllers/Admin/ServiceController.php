<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::ordered()->get();
        return view('admin.cms.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.cms.services.form', ['service' => new Service()]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'           => 'required|string|max:255',
            'tab_label'       => 'required|string|max:100',
            'description'     => 'required|string',
            'content'         => 'nullable|string',
            'image'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'bg_label'        => 'nullable|string|max:20',
            'icon_class'      => 'nullable|string|max:100',
            'whatsapp_number' => 'nullable|string|max:30',
            'order'           => 'nullable|integer',
            'is_active'       => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('services', 'public');
        }

        $validated['slug']      = Str::slug($validated['title']);
        $validated['is_active'] = $request->boolean('is_active', true);

        Service::create($validated);

        return redirect()->route('admin.cms.services.index')
            ->with('success', 'Layanan berhasil ditambahkan!');
    }

    public function edit(Service $service)
    {
        return view('admin.cms.services.form', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'title'           => 'required|string|max:255',
            'tab_label'       => 'required|string|max:100',
            'description'     => 'required|string',
            'content'         => 'nullable|string',
            'image'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'bg_label'        => 'nullable|string|max:20',
            'icon_class'      => 'nullable|string|max:100',
            'whatsapp_number' => 'nullable|string|max:30',
            'order'           => 'nullable|integer',
            'is_active'       => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            if ($service->image && Storage::disk('public')->exists($service->image)) {
                Storage::disk('public')->delete($service->image);
            }
            $validated['image'] = $request->file('image')->store('services', 'public');
        }

        $validated['is_active'] = $request->boolean('is_active');

        $service->update($validated);

        return redirect()->route('admin.cms.services.index')
            ->with('success', 'Layanan berhasil diperbarui!');
    }

    public function destroy(Service $service)
    {
        if ($service->image && Storage::disk('public')->exists($service->image)) {
            Storage::disk('public')->delete($service->image);
        }
        $service->delete();

        return redirect()->route('admin.cms.services.index')
            ->with('success', 'Layanan berhasil dihapus.');
    }

    // ── AJAX: update urutan via drag & drop ───────────────────────────
    public function reorder(Request $request)
    {
        $request->validate(['order' => 'required|array']);
        foreach ($request->order as $position => $id) {
            Service::where('id', $id)->update(['order' => $position + 1]);
        }
        return response()->json(['success' => true]);
    }
}