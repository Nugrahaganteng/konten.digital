<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SiteSettingController extends Controller
{
    // ── Tampilkan form per group ──────────────────────────────────────
    public function index(string $group = 'hero')
    {
        $allowedGroups = ['hero', 'about', 'contact', 'footer', 'seo', 'social'];

        if (! in_array($group, $allowedGroups)) {
            $group = 'hero';
        }

        $settings = SiteSetting::where('group', $group)
            ->orderBy('id')
            ->get()
            ->keyBy('key');

        return view('admin.cms.settings', compact('settings', 'group', 'allowedGroups'));
    }

    // ── Simpan semua field dari satu group ────────────────────────────
    public function update(Request $request, string $group)
    {
        $fields = $request->except(['_token', '_method']);

        foreach ($fields as $key => $value) {
            $setting = SiteSetting::where('key', $key)->where('group', $group)->first();

            if (! $setting) {
                continue;
            }

            // Handle upload gambar
            if ($setting->type === 'image' && $request->hasFile($key)) {
                $file = $request->file($key);
                $file->validate(['image', 'mimes:jpg,jpeg,png,webp,svg', 'max:2048']);

                // Hapus gambar lama
                if ($setting->value && Storage::disk('public')->exists($setting->value)) {
                    Storage::disk('public')->delete($setting->value);
                }
                $value = $file->store('cms/' . $group, 'public');
            }

            $setting->update(['value' => $value]);
        }

        // Handle file upload yang tidak ada di $fields (karena input file kosong)
        foreach (SiteSetting::where('group', $group)->where('type', 'image')->get() as $imgSetting) {
            if ($request->hasFile($imgSetting->key)) {
                $file = $request->file($imgSetting->key);
                if ($imgSetting->value && Storage::disk('public')->exists($imgSetting->value)) {
                    Storage::disk('public')->delete($imgSetting->value);
                }
                $imgSetting->update(['value' => $file->store('cms/' . $group, 'public')]);
            }
        }

        SiteSetting::flushCache();

        return redirect()
            ->route('admin.cms.settings', $group)
            ->with('success', 'Pengaturan ' . strtoupper($group) . ' berhasil disimpan!');
    }
}