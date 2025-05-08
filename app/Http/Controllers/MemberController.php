<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Spatie\SimpleExcel\SimpleExcelReader;


class MemberController extends Controller
{
    public function index()
    {
        $data = array(
            "title" => "Data Member",
            "menuAdminMember" => "menu-open",
            "member"  => Member::all(),
        );
        return view('admin.member.index', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nas' => [
                'required',
                'string',
                'max:10',
                Rule::unique(Member::class, 'nas'),
            ],
            'syubah' => 'required|string',
            'farah' => 'required|string',
            'holaqoh' => 'required|string|max:10',
        ],[
            'name.required'         => 'Nama tidak boleh kosong',
            'nas.required'        => 'Nas tidak boleh kosong',
            'nas.unique'          => 'Nas sudah terdaftar',
            'syubah.required'          => 'Syubah tidak boleh kosong',
            'farah.required'          => 'Farah tidak boleh kosong',
            'holaqoh.required'          => 'Holaqoh tidak boleh kosong',
    ]);

        Member::create([
            'name' => $request->name,
            'nas' => $request->nas,
            'syubah' => $request->syubah,
            'farah' => $request->farah,
            'holaqoh' => $request->holaqoh,
            
        ]);

        return redirect()->route('member.index')->with('success', 'Member berhasil ditambahkan.');
    }

    public function show($id)
    {
        $data = array(
            "title" => "Detail User",
            "menuAdminMember" => "menu-open",
            "member"  => Member::findOrFail($id),
        );
        return view('admin.member.show', $data);
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'      => 'required',
            'nas'     => 'required|unique:members,nas,' .$id,
            'syubah'   => 'required|string',
            'holaqoh'   => 'required|string',
            'farah'   => 'required|string',
            
        ],[
            'name.required'         => 'Nama tidak boleh kosong',
            'nas.required'        => 'Nas tidak boleh kosong',
            'nas.unique'          => 'Nas sudah terdaftar',
            'syubah.required'      => 'syubah tidak boleh kosong',
            'holaqoh.required'      => 'holaqoh tidak boleh kosong',
            'farah.required'      => 'farah tidak boleh kosong',

        ]);
        $user = Member::findOrFail($id);

            $user->update([
                'name' => $request->name,
                'nas' => $request->nas,
                'syubah' => $request->syubah,
                'holaqoh' => $request->holaqoh,
                'farah' => $request->farah,
                
            ]);
        
        return redirect()->route('member.index')->with('success', 'Member berhasil diupdate.');
    }



    public function showImportForm()
    {
        $data = array(
            "title" => "Data Member",
            "menuAdminMember" => "menu-open",
        );
        return view('admin.member.import', $data);
    }
    
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,csv',
        ]);
    
        if (!$request->hasFile('file')) {
            return back()->withErrors(['file' => 'Tidak ada file yang diupload.']);
        }
        dd($request->file('file'));
        $filePath = $request->file('file')->store('temp');
    
        SimpleExcelReader::create(storage_path('app/' . $filePath))
            ->getRows()
            ->each(function(array $row) {
                Member::create([
                    'name'    => $row['name'],
                    'nas'     => $row['nas'],
                    'syubah'  => $row['syubah'],
                    'holaqoh' => $row['holaqoh'],
                    'farah'   => $row['farah'],
                ]);
            });

        return redirect()->route('admin.member.index')->with('success', 'Import berhasil!');
    }


    public function destroy($id)
    {
        Member::destroy($id);
        return redirect()->route('member.index')->with('success', 'Data berhasil dihapus!');
    }

    

}
