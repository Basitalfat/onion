<?php

namespace App\Http\Controllers;

use App\Models\Pengisi;
use Illuminate\Http\Request;

class PengisiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = array(
            "title" => "Data Mudzakir",
            "menuAdminPengisi" => "menu-open",
            "pengisi"  => Pengisi::all(),
        );
        return view('admin.pengisi.index', $data);
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
            "syubah" => 'nullable|string|max:50',
            "status" => 'required',
        ]);
        Pengisi::create([
            'name' => $request->name,
            'syubah' => $request->syubah,
            'status' => $request->status,
        ]);
        return redirect()->route('pengisi.index')->with('success', 'Mudzakir berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = array(
            "title" => "Detail pengisi",
            "menuAdminPengisi" => "menu-open",
            "pengisi"  => Pengisi::findOrFail($id),
        );
        return view('admin.pengisi.show', $data);
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
            'syubah'    => 'nullable|string|max:50',
            'status'   => 'required',
        ],[
            'name.required'         => 'Nama tidak boleh kosong',
            'status.required'      => 'Status tidak boleh kosong',
        ]);
        $pengisi = Pengisi::findOrFail($id);

            $pengisi->update([
                'name' => $request->name,
                'syubah' => $request->syubah,
                'status' => $request->status,
            ]);
        
        return redirect()->route('pengisi.index')->with('success', 'Pengisi berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Pengisi::destroy($id);
        return redirect()->route('pengisi.index')->with('success', 'Data berhasil dihapus!');
    }
}
