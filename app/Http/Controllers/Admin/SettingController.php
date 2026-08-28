<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    public function index()
    {
        $admin1 = Setting::where('key', 'wa_admin_1')->value('value') ?? '6289523195549';
        $admin2 = Setting::where('key', 'wa_admin_2')->value('value') ?? '6282148882473';
        $alamat = Setting::where('key', 'alamat')->value('value') ?? '';
        $tentang_kami = Setting::where('key', 'tentang_kami')->value('value') ?? 'Menyediakan Koleksi Baju Muslim & Muslimah Terlengkap dan Berkualitas di Kalimantan. Melayani satuan dan partai besar.';
        $google_maps_url = Setting::where('key', 'google_maps_url')->value('value') ?? 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3982.650678307639!2d114.8136408!3d-3.4349013000000004!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2de6813466be6fdf%3A0x88ff5990fc0fa984!2sNIBRAS%20BANJARBARU!5e0!3m2!1sid!2sid!4v1772500565133!5m2!1sid!2sid';

        return view('admin.settings.index', compact('admin1', 'admin2', 'alamat', 'tentang_kami', 'google_maps_url'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'wa_admin_1' => 'required|string',
            'wa_admin_2' => 'required|string',
            'alamat' => 'required|string',
            'tentang_kami' => 'required|string',
            'google_maps_url' => 'required|string',
        ]);

        Setting::updateOrCreate(['key' => 'wa_admin_1'], ['value' => $request->wa_admin_1]);
        Setting::updateOrCreate(['key' => 'wa_admin_2'], ['value' => $request->wa_admin_2]);
        Setting::updateOrCreate(['key' => 'alamat'], ['value' => $request->alamat]);
        Setting::updateOrCreate(['key' => 'tentang_kami'], ['value' => $request->tentang_kami]);
        Setting::updateOrCreate(['key' => 'google_maps_url'], ['value' => $request->google_maps_url]);

        return back()->with('success', 'Pengaturan berhasil diperbarui.');
    }
}
