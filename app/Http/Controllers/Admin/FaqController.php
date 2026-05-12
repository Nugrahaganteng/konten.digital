<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::ordered()->get()->groupBy('category');
        return view('admin.cms.faqs.index', compact('faqs'));
    }

    public function create()
    {
        return view('admin.cms.faqs.form', ['faq' => new Faq()]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'question'  => 'required|string',
            'answer'    => 'required|string',
            'category'  => 'required|string|max:50',
            'order'     => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active', true);

        Faq::create($validated);

        return redirect()->route('admin.cms.faqs.index')
            ->with('success', 'FAQ berhasil ditambahkan!');
    }

    public function edit(Faq $faq)
    {
        return view('admin.cms.faqs.form', compact('faq'));
    }

    public function update(Request $request, Faq $faq)
    {
        $validated = $request->validate([
            'question'  => 'required|string',
            'answer'    => 'required|string',
            'category'  => 'required|string|max:50',
            'order'     => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active');
        $faq->update($validated);

        return redirect()->route('admin.cms.faqs.index')
            ->with('success', 'FAQ berhasil diperbarui!');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();
        return redirect()->route('admin.cms.faqs.index')
            ->with('success', 'FAQ berhasil dihapus.');
    }
}