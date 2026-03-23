<?php

namespace App\Http\Controllers;

use App\Models\LogActivity;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email',],
            'password' => ['required'],
        ]);


        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
            if ($user && $user->role === 'peminjam') {
                LogActivity::create([
                    'user_id' => $user->id,
                    'activity' => 'login',
                ]);
            }

            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role === 'petugas') {
                return redirect()->route('petugas.dashboard');
            } elseif ($user->role === 'peminjam') {
                return redirect()->route('peminjam.dashboard');
            } else {
                Auth::logout();
                return redirect()->route('login')->with('error', 'Role pengunna tidak di temukan');
            }
        } else {
            return redirect()->back()->withErrors(['email' => 'email, atau password salah'])->onlyInput('email');
        }
    }

    public function logout(Request $request)
    {
        $user = Auth::user();
        if ($user && $user->role === 'peminjam') {
                LogActivity::create([
                    'user_id' => $user->id,
                    'activity' => 'logout',
                ]);
            }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('status', 'Anda telah berhasil logout.')->onlyInput('email');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        User::where('id', $id)->delete();
    }
}
