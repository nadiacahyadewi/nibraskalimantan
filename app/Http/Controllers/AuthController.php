<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    private function syncCart()
    {
        $sessionId = \Illuminate\Support\Facades\Session::getId();
        $guestCart = \App\Models\Cart::where('session_id', $sessionId)->first();

        if ($guestCart) {
            $userCart = \App\Models\Cart::firstOrCreate(['user_id' => Auth::id()]);

            if ($userCart->id !== $guestCart->id) {
                foreach ($guestCart->items as $item) {
                    $existingItem = $userCart->items()
                        ->where('product_id', $item->product_id)
                        ->where('size', $item->size)
                        ->first();

                    if ($existingItem) {
                        $existingItem->quantity += $item->quantity;
                        $existingItem->save();
                    } else {
                        $item->cart_id = $userCart->id;
                        $item->save();
                    }
                }
                $guestCart->delete(); // Delete empty guest cart
            }
        }
    }

    /**
     * Handle an authentication attempt.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:8', 'max:20'],
        ], [
            'password.min' => 'Password minimal 8 karakter',
            'password.max' => 'Password maksimal 20 karakter',
        ]);

        $remember = $request->has('remember-me');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            $this->syncCart();

            // Redirect based on role
            if (Auth::user()->role === 'admin') {
                return redirect()->intended('/admin/dashboard');
            }

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'Kredensial yang diberikan tidak cocok dengan data kami.',
        ])->onlyInput('email');
    }

    /**
     * Show the registration form.
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Handle a registration request.
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:50', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'max:20', 'confirmed'],
        ], [
            'name.min' => 'Username minimal 3 karakter',
            'name.max' => 'Username maksimal 50 karakter',
            'name.unique' => 'Username sudah digunakan',
            'email.unique' => 'Email sudah digunakan',
            'password.min' => 'Password minimal 8 karakter',
            'password.max' => 'Password maksimal 20 karakter',
        ]);

        $this->generateAndSendOtp($request->email, $request->all());

        return redirect()->route('register.verify')->with('email', $request->email);
    }

    private function generateAndSendOtp($email, $data = null)
    {
        $otp = rand(100000, 999999);
        
        // If data is null, fetch existing data from cache
        if ($data === null) {
            $data = \Illuminate\Support\Facades\Cache::get('register_data_' . $email);
        }

        // Cache the OTP for 1 minute
        \Illuminate\Support\Facades\Cache::put('register_otp_' . $email, (string) $otp, now()->addMinutes(1));
        
        // Cache the registration data for 60 minutes
        if ($data) {
            \Illuminate\Support\Facades\Cache::put('register_data_' . $email, $data, now()->addMinutes(60));
        }

        \Illuminate\Support\Facades\Mail::to($email)->send(new \App\Mail\RegisterOtpMail($otp));
    }

    public function showVerifyOtpForm(Request $request)
    {
        $email = session('email') ?? $request->old('email');
        if (!$email) {
            return redirect()->route('register')->withErrors(['email' => 'Silakan daftar terlebih dahulu.']);
        }
        return view('auth.verify-otp', compact('email'));
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|string|size:6'
        ]);

        $cachedOtp = \Illuminate\Support\Facades\Cache::get('register_otp_' . $request->email);
        $cachedData = \Illuminate\Support\Facades\Cache::get('register_data_' . $request->email);

        if (!$cachedData) {
            return back()->withErrors(['otp' => 'Sesi pendaftaran tidak ditemukan. Silakan daftar ulang.'])->withInput(['email' => $request->email]);
        }

        if (!$cachedOtp) {
            return back()->withErrors(['otp' => 'Kode OTP telah kedaluwarsa. Silakan kirim ulang OTP.'])->withInput(['email' => $request->email]);
        }

        if ($cachedOtp !== $request->otp) {
            return back()->withErrors(['otp' => 'Kode OTP salah.'])->withInput(['email' => $request->email]);
        }

        // OTP is correct, create the user
        $data = $cachedData;
        
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'user',
        ]);

        \Illuminate\Support\Facades\Cache::forget('register_otp_' . $request->email);
        \Illuminate\Support\Facades\Cache::forget('register_data_' . $request->email);

        Auth::login($user);
        $this->syncCart();

        return redirect('/')->with('success', 'Akun berhasil dibuat dan email telah terverifikasi.');
    }

    public function resendOtp(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $data = \Illuminate\Support\Facades\Cache::get('register_data_' . $request->email);
        
        if (!$data) {
            // Data lost from cache (expired > 60 min). They must re-register.
            return back()->withErrors(['otp' => 'Sesi pendaftaran telah kedaluwarsa. Silakan daftar ulang dari awal.'])->withInput(['email' => $request->email]);
        }

        $this->generateAndSendOtp($request->email, $data);

        return back()->with('status', 'Kode OTP baru telah dikirim ke email Anda.')->withInput(['email' => $request->email]);
    }

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
