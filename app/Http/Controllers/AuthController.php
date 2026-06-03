<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Tampilkan Form Login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Proses Login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // ==================================================
            // LOGIKA PEMISAHAN ROLE (REDIRECT OTOMATIS)
            // ==================================================
            $userRole = Auth::user()->role;

            if ($userRole === 'admin') {
                return redirect()->route('admin.pengguna')->with('success', 'Selamat datang kembali, Administrator!');
            } elseif ($userRole === 'distributor') {
                return redirect()->route('distributor.dashboard')->with('success', 'Selamat datang, Mitra Distributor!');
            } else {
                // Default ke dashboard petani
                return redirect()->route('dashboard')->with('success', 'Selamat datang kembali, Petani!');
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    // Tampilkan Form Register
    public function showRegister()
    {
        return view('auth.register');
    }

    // Proses Register
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:petani,distributor' 
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        Auth::login($user);

        // ==================================================
        // LOGIKA PEMISAHAN ROLE SAAT REGISTRASI BARU
        // ==================================================
        if ($user->role === 'distributor') {
            return redirect()->route('distributor.dashboard')->with('success', 'Registrasi berhasil. Selamat datang, Mitra Distributor!');
        } else {
            return redirect()->route('dashboard')->with('success', 'Registrasi berhasil. Selamat datang di Sistem Tani!');
        }
    }

    // Proses Update Profil
    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'password' => 'nullable|min:6|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }

    // Proses Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}