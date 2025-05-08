<?php

namespace App\Http\Controllers;

use id;
use App\Models\Member;
use App\Models\Absensi;
use App\Models\Tausiyah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TausiyahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = array(
            "title" => "Data Tausiyah",
            "menuMudirTausiyah" => "menu-open",
            "tausiyah"  => Tausiyah::where('user_id', Auth::id())->get(),
        );
        return view('mudir.tausiyah.index', $data);
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
            "pengisi" => 'required|string',
            "tempat" => 'required|string',
            "holaqoh" => 'required|string',
            "farah" => 'required|string',
        ],[
            'pengisi.required'         => 'Pengisi tidak boleh kosong',
            'tempat.required'        => 'Email tidak boleh kosong',
            'holaqoh.required'        => 'Email tidak boleh kosong',
            'farah.required'        => 'Email tidak boleh kosong',
    ]);

    Tausiyah::create([
        'pengisi' => $request->pengisi,
        'tempat' => $request->tempat,
        'bulan' => now()->format('d F Y'),
        'holaqoh' => $request->holaqoh,
        'farah' => $request->farah,
        'user_id' => Auth::id(),
    ]);

    return redirect()->route('tausiyah.index')->with('success', 'Tausiyah berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tausiyah = Tausiyah::findOrFail($id);

        $members = Member::where('syubah', Auth::user()->syubah)
        ->where('holaqoh', $tausiyah->holaqoh)
        ->where('farah', $tausiyah->farah)
        ->get();
        $absensi = Absensi::where('tausiyah_id', $tausiyah->id)->with('member')->get();
        $data = array(
            "title" => "Detail Tausiyah & Kehadiran",
            "menuMudirTausiyah" => "menu-open",
            "tausiyah"  => $tausiyah,
            "members" => $members,
            "absensi" => $absensi,
        );
        
        return view('mudir.tausiyah.show', $data);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Tausiyah::destroy($id);
        return redirect()->route('tausiyah.index')->with('success', 'Tausiyah berhasil dihapus!');
    }
}
