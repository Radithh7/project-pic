<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use App\Http\Requests\UserAuthVerifyRequest;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman login.
     */
    public function index(): View
    {
        return view('auth.login');
    }

    /**
     * Menampilkan halaman register.
     */
    public function showRegisterForm(): View
    {
        return view('auth.register'); // Pastikan nama view-nya sesuai dengan nama file tampilan Anda
    }

    /**
     * Menangani proses verifikasi login.
     */
    public function verify(UserAuthVerifyRequest $request): RedirectResponse
    {
        $data = $request->validated();
    
        // Cek login untuk admin
        if (Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password'], 'role' => 'admin'])) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');  // Arahkan ke dashboard admin
        }

        // Cek login untuk user
        else if (Auth::guard('user')->attempt(['email' => $data['email'], 'password' => $data['password'], 'role' => 'user'])) {
            $request->session()->regenerate();
            return redirect()->intended('/');  // Arahkan ke dashboard user
        }

        // Jika login gagal, kembalikan dengan pesan error
        else {
            return redirect(route('login'))->with('msg', 'Email dan password salah');
        }
    }

    /**
     * Menangani proses pendaftaran pengguna baru.
     */
    public function register(Request $request): RedirectResponse
    {
        // Validasi input untuk pendaftaran
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed|min:8',
        ]);

        // Buat user baru dengan role 'user'
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'role' => 'user', // Menetapkan role sebagai 'user'
        ]);

        // Login otomatis setelah pendaftaran
        Auth::guard('user')->login($user);
    
        // Redirect ke halaman login setelah berhasil mendaftar
        return redirect()->route('login')->with('success', 'Pendaftaran berhasil! Silakan login.');
    }

    /**
     * Menangani logout dan mengarahkan pengguna ke halaman login.
     */
    public function logout(Request $request): RedirectResponse
    {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        } else if (Auth::guard('user')->check()) {
            Auth::guard('user')->logout();
        }
    
        // Invalidate session dan regenerate token CSRF
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return redirect(route('login'))->with('success', 'Berhasil logout!');
    }
}
