<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Kategori;
use App\Models\LogActivity;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            $activity = LogActivity::with('user')->orderByDesc('created_at')->get();
            $logToday = LogActivity::whereDate('created_at', today())->where('activity', 'login')->count();
            $Totaluser = User::where('role', 'peminjam')->count();
            $Totaluser2 = User::where('role', 'petugas')->count();
            $Totalalat = Alat::all()->count();
            return view('admin.dashboard', compact('activity', 'logToday', 'Totalalat', 'Totaluser', 'Totaluser2'));
        } else if ($user->role === 'petugas') {
            return view('petugas.dashboard');
        } else if ($user->role === 'peminjam') {
            $alat = Alat::all();
            return view('peminjam.dashboard', compact('alat'));
        } else {
            abort(403, 'Role pengguna tidak diketahui');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
