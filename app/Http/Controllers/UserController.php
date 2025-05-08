<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;

use Illuminate\Support\Facades\Hash;
use function Laravel\Prompts\password;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = array(
            "title" => "Data User",
            "menuAdminUser" => "menu-open",
            "user"  => User::all(),
        );
        return view('admin.user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => 'required|string|max:50',
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            "role" => 'required',
            'syubah' => 'required',
            'password' => 'required|confirmed|min:8',
        ],[
            'name.required'         => 'Nama tidak boleh kosong',
            'email.required'        => 'Email tidak boleh kosong',
            'email.unique'          => 'Email sudah terdaftar',
            'role.required'        => 'Role tidak boleh kosong',
            'syubah.required'        => 'Syubah tidak boleh kosong',
            'password.required'     => 'Password tidak boleh kosong',
            'password.confirmed'    => 'Password konfirmasi tidak sama',
            'password.min'  => 'Password minimal 8 karakter',
    ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'syubah' => $request->syubah,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan.');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = array(
            "title" => "Detail User",
            "menuAdminUser" => "menu-open",
            "user"  => User::findOrFail($id),
        );
        return view('admin.user.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'      => 'required',
            'email'     => 'required|unique:users,email,' .$id,
            'role'   => 'required',
            'syubah'   => 'required',
            'password'  => 'nullable|confirmed|min:8',
        ],[
            'name.required'         => 'Nama tidak boleh kosong',
            'email.required'        => 'Email tidak boleh kosong',
            'email.unique'          => 'Email sudah terdaftar',
            'role.required'      => 'role tidak boleh kosong',
            'syubah.required'      => 'syubah tidak boleh kosong',
            'password.required'     => 'Password tidak boleh kosong',
            'password.confirmed'    => 'Password konfirmasi tidak sama',
            'password.min'  => 'Password minimal 8 karakter',
        ]);
        $user = User::findOrFail($id);

        // Kalau password diisi, update semuanya termasuk password
        if ($request->filled('password')) {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
                'syubah' => $request->syubah,
                'password' => Hash::make($request->password),
            ]);
        } else {
            // Kalau password kosong, update tanpa ubah password
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
                'syubah' => $request->syubah,
            ]);
        }

        return redirect()->route('user.index')->with('success', 'User berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('user.index')->with('success', 'Data berhasil dihapus!');
    }
}
