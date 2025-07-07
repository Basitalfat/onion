<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Holaqoh;
use Illuminate\Http\Request;
use App\Models\DetailHolaqoh;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Spatie\SimpleExcel\SimpleExcelReader;


class HolaqohController extends Controller
{
    public function index()
    {
        $data = array(
            "title" => "Data Halaqoh",
            "menuAdminHolaqoh" => "menu-open",
            "holaqoh"  => Holaqoh::all(),
        );
        return view('admin.holaqoh.index', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_holaqoh' => 'required|string|max:10',
            'name' => 'required|string|max:255',
            'syubah' => 'required|string',
        ],[
            'kode_holaqoh.required'          => 'Holaqoh tidak boleh kosong',
            'name.required'         => 'Nama tidak boleh kosong',
            'syubah.required'          => 'Syubah tidak boleh kosong',
    ]);

        Holaqoh::create([
            'kode_holaqoh' => $request->kode_holaqoh,
            'name' => $request->name,
            'syubah' => $request->syubah,
            
        ]);

        return redirect()->route('holaqoh.index')->with('success', 'Data Holaqoh berhasil ditambahkan.');
    }

    public function show($id)
    {
        $holaqoh = Holaqoh::findOrFail($id);
        $data = array(
            "title" => "Edit Data Halaqoh",
            "menuAdminHolaqoh" => "menu-open",
            "holaqoh"  => Holaqoh::findOrFail($id),
            "members" => Member::where('syubah', $holaqoh->syubah)->get(),
            "detail_holaqoh" => DetailHolaqoh::with('member')
                            ->where('holaqoh_id', $id)
                            ->get(),
                        
        );
        return view('admin.holaqoh.show', $data);
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'kode_holaqoh'   => 'required|string',
            'name'      => 'required',
            
        ],[
            'kode_holaqoh.required'      => 'Holaqoh tidak boleh kosong',
            'name.required'         => 'Nama tidak boleh kosong',

        ]);
        $user = Holaqoh::findOrFail($id);

            $user->update([
                'kode_holaqoh' => $request->kode_holaqoh,
                'name' => $request->name,
            ]);
        
        return redirect()->route('holaqoh.index')->with('success', 'Kode Holaqoh berhasil diupdate.');
    }

    public function showImportForm()
    {
        return view('admin.holaqoh.import', [
            'title' => 'Import Holaqoh',
            'menuAdminHolaqoh' => 'menu-open'
        ]);
    }

    public function destroy($id)
    {
        Holaqoh::destroy($id);
        return redirect()->route('holaqoh.index')->with('success', 'Data Holah berhasil dihapus!');
    }
}