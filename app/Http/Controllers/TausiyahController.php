<?php

namespace App\Http\Controllers;

use id;
use App\Models\Member;
use App\Models\Absensi;
use App\Models\Holaqoh;
use App\Models\Pengisi;
use App\Models\Tausiyah;
use Illuminate\Http\Request;
use App\Models\DetailHolaqoh;
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
            $tausiyah = Tausiyah::with('holaqoh')->orderBy('created_at', 'desc')->get();
        } else {
            // Jika mudir, ambil data tausiyah milik user yang login
            $tausiyah = Tausiyah::with('holaqoh')->where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        }

        $data = array(
            "title" => "Data Tausiyah",
            "menuMudirTausiyah" => "menu-open",
            "tausiyah"  => $tausiyah,
            "holaqohs" => Holaqoh::all(),
            "pengisi" => Pengisi::orderBy('name', 'asc')->get(),
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
            "pengisi_id" => 'required|exists:pengisi,id',
            "tempat" => 'required|string',
            'holaqoh_id' => 'required|exists:holaqohs,id',
            "media" => 'required|in:online,offline,hybrid',

        ],[
            'pengisi_id.required' => 'Pengisi tidak boleh kosong',
            'tempat.required'        => 'Email tidak boleh kosong',

    ]);

    $tausiyah = Tausiyah::create([
        'pengisi_id' => $request->pengisi_id,
        'tempat' => $request->tempat,
        'bulan' => $request->tanggal,
        'holaqoh_id' => $request->holaqoh_id,
        'media' => $request->media,
        'user_id' => Auth::id(),
    ]);
        // Ambil semua member_id dari detail_holaqoh berdasarkan holaqoh_id
    $memberIds = DetailHolaqoh::where('holaqoh_id', $request->holaqoh_id)
        ->pluck('member_id');

         // Buat data absensi untuk masing-masing member
    $absensiData = [];
    foreach ($memberIds as $memberId) {
        $absensiData[] = [
            'tausiyah_id' => $tausiyah->id,
            'member_id'   => $memberId,
            'status'   => 'hadir',
            'ket'   => 'hadir',
            'created_at'  => now(),
            'updated_at'  => now(),
        ];
    }
       // Masukkan semuanya sekaligus
    Absensi::insert($absensiData);
    return redirect()->route('tausiyah.show', $tausiyah->id)->with('success', 'Tausiyah dan data absensi berhasil ditambahkan.');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
{
    // Untuk admin, tampilkan semua tausiyah. Untuk mudir, hanya tampilkan tausiyah miliknya
    if (Auth::user()->role === 'admin') {
        $tausiyah = Tausiyah::findOrFail($id);
    } else {
        $tausiyah = Tausiyah::where('user_id', Auth::id())->findOrFail($id);
    }

    // Ambil absensi lengkap dengan data member
    $absensis = Absensi::with('member')
        ->where('tausiyah_id', $tausiyah->id)
        ->orderBy('created_at', 'desc')
        ->get();

    // Hitung persentase absensi
    $jumlahIzin = $absensis->where('status', 'izin')->count();
    $jumlahTanpaKeterangan = $absensis->where('status', 'tanpa_keterangan')->count();
    $jumlahHadir = $absensis->where('status', 'hadir')->count();
    $jumlahSakit = $absensis->where('status', 'sakit')->count();
    
    $jml = $jumlahIzin + $jumlahTanpaKeterangan;
    $jwh = $jumlahHadir + $jumlahIzin + $jumlahTanpaKeterangan;
    
    $persentase_absensi = $jwh > 0 ? round(($jml / $jwh) * 100, 2) : 0;

    $data = [
        "title" => "Detail Tausiyah & Kehadiran",
        "menuMudirTausiyah" => "menu-open",
        "tausiyah" => $tausiyah,
        "absensis" => $absensis,
        "persentase_absensi" => $persentase_absensi,
        "jumlahHadir" => $jumlahHadir,
        "jumlahIzin" => $jumlahIzin,
        "jumlahSakit" => $jumlahSakit,
        "jumlahTanpaKeterangan" => $jumlahTanpaKeterangan,
        "jwh" => $jwh,
    ];

    return view('mudir.tausiyah.show', $data);
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Untuk admin, tampilkan semua tausiyah. Untuk mudir, hanya tampilkan tausiyah miliknya
        if (Auth::user()->role === 'admin') {
            $tausiyah = Tausiyah::findOrFail($id);
        } else {
            $tausiyah = Tausiyah::where('user_id', Auth::id())->findOrFail($id);
        }
        // Implement edit logic here if needed
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Untuk admin, tampilkan semua tausiyah. Untuk mudir, hanya tampilkan tausiyah miliknya
        if (Auth::user()->role === 'admin') {
            $tausiyah = Tausiyah::findOrFail($id);
        } else {
            $tausiyah = Tausiyah::where('user_id', Auth::id())->findOrFail($id);
        }
        // Implement update logic here if needed
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Untuk admin, tampilkan semua tausiyah. Untuk mudir, hanya tampilkan tausiyah miliknya
        if (Auth::user()->role === 'admin') {
            $tausiyah = Tausiyah::findOrFail($id);
        } else {
            $tausiyah = Tausiyah::where('user_id', Auth::id())->findOrFail($id);
        }
        $tausiyah->delete();
        return redirect()->route('tausiyah.index')->with('success', 'Tausiyah berhasil dihapus!');
    }
}
