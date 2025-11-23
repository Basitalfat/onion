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
            "holaqohs" => Holaqoh::orderBy('kode_holaqoh', 'asc')->get(),
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
            'holaqoh_id' => 'nullable|exists:holaqohs,id',
        ],[
            'name.required'         => 'Nama tidak boleh kosong',
            'nas.required'        => 'Nas tidak boleh kosong',
            'nas.unique'          => 'Nas sudah terdaftar',
            'syubah.required'          => 'Syubah tidak boleh kosong',
    ]);

        $member = Member::create([
            'name' => $request->name,
            'nas' => $request->nas,
            'syubah' => $request->syubah,
            'holaqoh_id' => $request->holaqoh_id,
        ]);

        // Auto-save to detail_holaqoh if holaqoh_id provided
        if ($request->holaqoh_id) {
            $holaqoh = Holaqoh::find($request->holaqoh_id);
            DetailHolaqoh::create([
                'holaqoh_id' => $request->holaqoh_id,
                'member_id' => $member->id,
                'syubah' => $holaqoh->syubah,
            ]);
        }

        return redirect()->route('member.index')->with('success', 'Umat berhasil ditambahkan.');
    }

    public function show($id)
    {
        $member = Member::findOrFail($id);

        $data = array(
            "title" => "Detail User",
            "menuAdminMember" => "menu-open",
            "member" => $member,
            "holaqohs" => Holaqoh::orderBy('kode_holaqoh', 'asc')->get(),
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
            'holaqoh_id' => 'nullable|exists:holaqohs,id',
        ],[
            'name.required'         => 'Nama tidak boleh kosong',
            'nas.required'        => 'Nas tidak boleh kosong',
            'nas.unique'          => 'Nas sudah terdaftar',
            'syubah.required'      => 'syubah tidak boleh kosong',

        ]);
        $user = Member::findOrFail($id);
        $oldHolaqohId = $user->holaqoh_id;

        $user->update([
            'name' => $request->name,
            'nas' => $request->nas,
            'syubah' => $request->syubah,
            'holaqoh_id' => $request->holaqoh_id,
        ]);
        
        // Auto-update detail_holaqoh if holaqoh changed
        if ($oldHolaqohId != $request->holaqoh_id) {
            // Delete old entry
            if ($oldHolaqohId) {
                DetailHolaqoh::where('member_id', $id)
                    ->where('holaqoh_id', $oldHolaqohId)
                    ->delete();
            }
            
            // Create new entry
            if ($request->holaqoh_id) {
                $holaqoh = Holaqoh::find($request->holaqoh_id);
                $exists = DetailHolaqoh::where('member_id', $id)
                    ->where('holaqoh_id', $request->holaqoh_id)
                    ->exists();
                    
                if (!$exists) {
                    DetailHolaqoh::create([
                        'holaqoh_id' => $request->holaqoh_id,
                        'member_id' => $id,
                        'syubah' => $holaqoh->syubah,
                    ]);
                }
            }
        }
        
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
                        // Find holaqoh by kode_holaqoh if provided
                        $holaqohId = null;
                        if (isset($row['holaqoh']) && !empty($row['holaqoh'])) {
                            $holaqoh = Holaqoh::where('kode_holaqoh', $row['holaqoh'])->first();
                            $holaqohId = $holaqoh ? $holaqoh->id : null;
                        }
                        
                        $member = Member::create([
                            'name'    => $row['name'],
                            'nas'     => $row['nas'],
                            'syubah'  => $row['syubah'],
                            'holaqoh_id' => $holaqohId,
                        ]);
                        
                        // Auto-save to detail_holaqoh if holaqoh_id exists
                        if ($holaqohId) {
                            $holaqoh = Holaqoh::find($holaqohId);
                            DetailHolaqoh::create([
                                'holaqoh_id' => $holaqohId,
                                'member_id' => $member->id,
                                'syubah' => $holaqoh->syubah,
                            ]);
                        }
                    }
                });
    
            return redirect()->route('member.import.form')->with('success', 'Import berhasil!');
        } catch (\Exception $e) {
            return back()->withErrors(['file' => 'Terjadi kesalahan saat membaca file: ' . $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        Member::destroy($id);
        return redirect()->route('member.index')->with('success', 'Data berhasil dihapus!');
    }
}