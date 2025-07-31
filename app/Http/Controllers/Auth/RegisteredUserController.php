<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Fktp;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'no_hp'    => ['required', 'string', 'max:20', 'unique:users,no_hp'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/[a-z]/',      // huruf kecil
                'regex:/[A-Z]/',      // huruf besar
                'regex:/[0-9]/',      // angka
                'regex:/[@$!%*?&#]/', // karakter spesial
                'confirmed',
            ],

            'role'     => ['required', 'in:admin,fkrtl,fktp,apotek'],
        ]);

        $apotekId = null;
        $fktpId = null;

        // Jika role = apotek → buat apotek_id auto increment
        if ($request->role === 'apotek') {
            $lastApotekId = User::where('role', 'apotek')->max('apotek_id');
            $apotekId = $lastApotekId ? $lastApotekId + 1 : 1;
        }

        // Jika role = fktp → cari atau buat FKTP
        if ($request->role === 'fktp') {
    $fktp = Fktp::whereRaw('LOWER(nama_fktp) = ?', [strtolower($request->name)])->first();

    if ($fktp) {
        $fktpId = $fktp->id;
    } else {
        return back()->withErrors(['name' => 'Nama FKTP tidak ditemukan di database.']);
    }
}



        // Buat user baru
        $user = User::create([
            'name'       => $request->name,
            'no_hp'      => $request->no_hp,
            'email'      => $request->email,
            'password'   => Hash::make($request->password),
            'role'       => $request->role,
            'apotek_id'  => $apotekId,
            'fktp_id'    => $fktpId,
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil, silakan login.');
    }
}
