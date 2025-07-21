<?php

namespace App\Http\Controllers;

use App\Models\DetailHolaqoh;
use App\Models\Holaqoh;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Spatie\SimpleExcel\SimpleExcelReader;


class MemberController extends Controller
{
    public function index()
    {
        $data = array(
            "title" => "Data Umat",
            "menuAdminMember" => "menu-open",
            "member"  => Member::all(),
            "detailHolaqoh" => DetailHolaqoh::with(['member', 'halaqoh'])->get(),
        );
        return view('admin.member.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Data Umat',
            'menuAdminMember' => 'menu-open',
        ];

        return view('admin.member.create', $data);
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
        ],[
            'name.required'         => 'Nama tidak boleh kosong',
            'nas.required'        => 'Nas tidak boleh kosong',
            'nas.unique'          => 'Nas sudah terdaftar',
            'syubah.required'          => 'Syubah tidak boleh kosong',
    ]);

        Member::create([
            'name' => $request->name,
            'nas' => $request->nas,
            'syubah' => $request->syubah,
        ]);

        return redirect()->route('member.index')->with('success', 'Umat berhasil ditambahkan.');
    }

    public function show($id)
    {
        $member = Member::findOrFail($id);

        $data = array(
            "title" => "Detail User",
            "menuAdminMember" => "menu-open",
            "member" => $member,
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
        ],[
            'name.required'         => 'Nama tidak boleh kosong',
            'nas.required'        => 'Nas tidak boleh kosong',
            'nas.unique'          => 'Nas sudah terdaftar',
            'syubah.required'      => 'syubah tidak boleh kosong',

        ]);
        $user = Member::findOrFail($id);

            $user->update([
                'name' => $request->name,
                'nas' => $request->nas,
                'syubah' => $request->syubah,
            ]);
        
        return redirect()->route('member.index')->with('success', 'Umat berhasil diupdate.');
    }

    public function showImportForm()
    {
        return view('admin.member.import', [
            'title' => 'Import Member',
            'menuAdminMember' => 'menu-open'
        ]);
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,csv,xls',
        ]);
    
        $tempPath = storage_path('app/temp');
        if (!File::exists($tempPath)) {
            File::makeDirectory($tempPath, 0755, true);
        }
    
        $filename = uniqid() . '.' . $request->file('file')->getClientOriginalExtension();
        $request->file('file')->move($tempPath, $filename);
    
        $fullPath = $tempPath . '/' . $filename;
    
        try {
            SimpleExcelReader::create($fullPath)
                ->getRows()
                ->each(function (array $row) {
                    if (
                        isset($row['name'], $row['nas'], $row['syubah'])
                    ) {
                        Member::create([
                            'name'    => $row['name'],
                            'nas'     => $row['nas'],
                            'syubah'  => $row['syubah'],
                        ]);
                    }
                });
    
            return redirect()->route('member.import.form')->with('success', 'Import berhasil!');
        } catch (\Exception $e) {
            return back()->withErrors(['file' => 'Terjadi kesalahan saat membaca file: ' . $e->getMessage()]);
        }
        SimpleExcelReader::create(storage_path('app/' . $filePath))
            ->getRows()
            ->each(function(array $row) {
                Member::create([
                    'name'    => $row['name'],
                    'nas'     => $row['nas'],
                    'syubah'  => $row['syubah'],
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