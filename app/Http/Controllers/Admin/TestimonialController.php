<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::ordered()->get();
        return view('admin.cms.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.cms.testimonials.form', ['testimonial' => new Testimonial()]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'      => 'required|string|max:100',
            'position'  => 'nullable|string|max:100',
            'company'   => 'nullable|string|max:100',
            'photo'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:1024',
            'content'   => 'required|string',
            'rating'    => 'required|integer|min:1|max:5',
            'order'     => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('testimonials', 'public');
        }

        $validated['is_active'] = $request->boolean('is_active', true);

        Testimonial::create($validated);

        return redirect()->route('admin.cms.testimonials.index')
            ->with('success', 'Testimoni berhasil ditambahkan!');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.cms.testimonials.form', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $validated = $request->validate([
            'name'      => 'required|string|max:100',
            'position'  => 'nullable|string|max:100',
            'company'   => 'nullable|string|max:100',
            'photo'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:1024',
            'content'   => 'required|string',
            'rating'    => 'required|integer|min:1|max:5',
            'order'     => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('photo')) {
            if ($testimonial->photo && Storage::disk('public')->exists($testimonial->photo)) {
                Storage::disk('public')->delete($testimonial->photo);
            }
            $validated['photo'] = $request->file('photo')->store('testimonials', 'public');
        }

        $validated['is_active'] = $request->boolean('is_active');
        $testimonial->update($validated);

        return redirect()->route('admin.cms.testimonials.index')
            ->with('success', 'Testimoni berhasil diperbarui!');
    }

    public function destroy(Testimonial $testimonial)
    {
        if ($testimonial->photo && Storage::disk('public')->exists($testimonial->photo)) {
            Storage::disk('public')->delete($testimonial->photo);
        }
        $testimonial->delete();

        return redirect()->route('admin.cms.testimonials.index')
            ->with('success', 'Testimoni berhasil dihapus.');
    }
}