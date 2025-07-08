<?php

namespace App\Http\Controllers;

use id;
use App\Models\Member;
use App\Models\Absensi;
use App\Models\Holaqoh;
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
        if (Auth::user()->role === 'admin') {
            // Jika admin, ambil semua data tausiyah
            $tausiyah = Tausiyah::with('holaqoh')->get();
        } else {
            // Jika mudir, ambil data tausiyah milik user yang login
            $tausiyah = Tausiyah::with('holaqoh')->where('user_id', Auth::id())->get();
        }

        $data = array(
            "title" => "Data Tausiyah",
            "menuMudirTausiyah" => "menu-open",
            "tausiyah"  => $tausiyah,
            "holaqohs" => Holaqoh::all(),
        );
        return view('mudir.tausiyah.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $holaqohs = Holaqoh::all(); // ambil semua data halaqoh
        return view('mudir.tausiyah.modal', compact('holaqohs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "tanggal" => 'required|date',
            "pengisi" => 'required|string',
            "tempat" => 'required|string',
            'holaqoh_id' => 'required|exists:holaqohs,id',
            "media" => 'required|in:online,offline,hybrid',

        ],[
            'pengisi.required'         => 'Pengisi tidak boleh kosong',
            'tempat.required'        => 'Email tidak boleh kosong',

    ]);

    Tausiyah::create([
        'tanggal' => $request->tanggal,
        'pengisi' => $request->pengisi,
        'tempat' => $request->tempat,
        'bulan' => now()->format('d F Y'),
        'holaqoh_id' => $request->holaqoh_id,
        'media' => $request->media,
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
            ->whereIn('id', function ($q) use ($tausiyah) {
                $q->select('member_id')
                    ->from('detail_holaqoh')
                    ->where('holaqoh_id', $tausiyah->holaqoh_id);
            })
            ->get();

         $absensis = Absensi::with('member')
            ->whereHas('member', function ($query) use ($tausiyah) {
                $query->where('syubah', Auth::user()->syubah)
                ->whereIn('id', function ($q) use ($tausiyah) {
                    $q->select('member_id')
                    ->from('detail_holaqoh')
                    ->where('holaqoh_id', $tausiyah->holaqoh_id);
                });
        })
        ->where('tausiyah_id', $tausiyah->id)
        ->get();
        
        // $absensi = Absensi::where('tausiyah_id', $tausiyah->id)->with('member')->get();
        $data = array(
            "title" => "Detail Tausiyah & Kehadiran",
            "menuMudirTausiyah" => "menu-open",
            "tausiyah"  => $tausiyah,
            "absensis" => $absensis,
            "members" => $members,
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
