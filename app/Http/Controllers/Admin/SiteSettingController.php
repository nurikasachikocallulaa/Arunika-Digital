<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiteSettingController extends Controller
{
    /**
     * Show the form for editing the site settings.
     */
    public function edit()
    {
        $settings = SiteSetting::first();
        
        // If no settings exist, create default settings
        if (!$settings) {
            $settings = SiteSetting::create([
                'phone' => '+62 123 4567 890',
                'email' => 'info@smkn4bogor.sch.id',
                'address' => 'Jl. Raya Tajur No. 69, Bogor, Jawa Barat',
                'facebook' => 'https://facebook.com/smkn4bogor',
                'instagram' => 'https://instagram.com/smkn4bogor',
                'youtube' => 'https://youtube.com/c/smkn4bogor',
                'map_embed' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.049882521692!2d106.82211897364498!3d-6.640728064914838!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c8b16ee07ef5%3A0x14ab253dd267de49!2sSMK%20Negeri%204%20Bogor%20(Nebrazka)!5e0!3m2!1sid!2sid!4v1763079992486!5m2!1sid!2sid'
            ]);
        }

        return view('admin.settings.edit', compact('settings'));
    }

    /**
     * Update the site settings in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:100',
            'address' => 'required|string',
            'facebook' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'youtube' => 'nullable|url|max:255',
            'map_embed' => 'required|string'
        ]);

        $settings = SiteSetting::findOrFail($id);
        $settings->update($validated);

        return redirect()->route('admin.settings.edit')
                        ->with('success', 'Pengaturan berhasil diperbarui!');
    }
}
