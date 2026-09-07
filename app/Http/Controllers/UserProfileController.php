<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    /**
     * Tampilkan halaman edit profil.
     */
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    /**
     * Update data profil pelanggan.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ]);

        $user->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->route('profile.edit')->with('success', 'Profil berhasil diperbarui!');
    }

    /**
     * Hapus akun pengguna.
     */
    public function destroy(Request $request)
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return back()->withErrors(['error' => 'Admin tidak dapat menghapus akunnya sendiri.']);
        }

        $request->validate([
            'password' => 'required',
        ]);

        if (!\Illuminate\Support\Facades\Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Password yang Anda masukkan salah.']);
        }

        Auth::logout();

        if ($user->delete()) {
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('/')->with('success', 'Akun Anda berhasil dihapus.');
        }

        return back()->withErrors(['error' => 'Gagal menghapus akun.']);
    }
}
