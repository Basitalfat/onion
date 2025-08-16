<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Absensi;
use App\Models\Tausiyah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $syubah = Auth::user()->syubah;

        $tausiyah = Tausiyah::with('user')
        ->whereHas('user', function ($query) use ($syubah) {
            $query->where('syubah', $syubah);
        })->get();
            $data = array(
                "title" => "Absensi Tausiyah",
                "menuSyubahLaporan" => "menu-open",
                "tausiyah"  => $tausiyah,
            );
        return view('syubah.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */

        public function create($tausiyahId)
{
    //
}
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'member_id' => 'required|exists:members,id',
            'status' => 'required|in:hadir,izin,sakit,tanpa_keterangan',
            'tausiyah_id' => 'required|exists:tausiyahs,id',
            'ket' => 'nullable|string|max:255',
        ]);
    
        Absensi::create([
            'member_id'    => $validated['member_id'],
            'tausiyah_id'  => $validated['tausiyah_id'],
            'status'       => $validated['status'],
            'ket'          => $validated['ket'],
        ]);
        $tausiyahId = $validated['tausiyah_id'];
        return redirect()->route('tausiyah.show', $tausiyahId)->with('success', 'Umat berhasil ditambahkan.');
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
                ->from('detail_holaqoh') // Ganti sesuai nama tabel yang benar
                ->where('holaqoh_id', $tausiyah->holaqoh_id);
            })
            ->get();

        $absensi = Absensi::where('tausiyah_id', $tausiyah->id)->with('member')->get();

        // Hitung jumlah untuk masing-masing status
        $jumlahIzin = $absensi->where('status', 'izin')->count();
        $jumlahTanpaKeterangan = $absensi->where('status', 'tanpa_keterangan')->count();
        $jumlahHadir = $absensi->where('status', 'hadir')->count();
        $jumlahSakit = $absensi->where('status', 'sakit')->count();

        $jml = $jumlahIzin + $jumlahTanpaKeterangan;
        $jwh = $jumlahHadir + $jumlahIzin + $jumlahTanpaKeterangan;

        $persentase_absensi = $jwh > 0 ? round(($jml / $jwh) * 100, 2) : 0;

        $data = array(
            "title" => "Detail Tausiyah & Kehadiran",
            "menuSyubahLaporan" => "menu-open",
            "tausiyah" => $tausiyah,
            "members" => $members,
            "absensi" => $absensi,
            "persentase_absensi" => $persentase_absensi,
            "jumlahHadir" => $jumlahHadir,
            "jumlahIzin" => $jumlahIzin,
            "jumlahSakit" => $jumlahSakit,
            "jumlahTanpaKeterangan" => $jumlahTanpaKeterangan,
            "jwh" => $jwh,
        );

        return view('syubah.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
            $absen = Absensi::findOrFail($id);
            $absen->status = $request->status;
            $absen->ket = $request->ket;
            $absen->save();

    return redirect()->back()->with('success', 'Data berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
