<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Absensi;
use App\Models\Tausiyah;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
class JamiahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $syubah = $request->input('syubah');

        $tausiyah = Tausiyah::with('user')
            ->when($syubah, function ($query) use ($syubah) {
                $query->whereHas('user', function ($q) use ($syubah) {
                    $q->where('syubah', $syubah);
                });
            })
            ->orderBy('created_at', 'desc')
            ->get();

            return view('jamiah.index', [
                'title' => 'Data Tausiyah',
                'tausiyah' => $tausiyah
            ]);
    }

     public function perLiqo(Request $request)
    {
        $syubah = $request->input('syubah');

        $tausiyah = Tausiyah::with('user')
            ->when($syubah, function ($query) use ($syubah) {
                $query->whereHas('user', function ($q) use ($syubah) {
                    $q->where('syubah', $syubah);
                });
            })
            ->orderBy('created_at', 'desc')
            ->get();

            return view('jamiah.index', [
                'title' => 'Data Tausiyah',
                'tausiyah' => $tausiyah
            ]);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tausiyah = Tausiyah::with('user')->findOrFail($id);
        $syubah = $tausiyah->user->syubah;

        $members = Member::where('syubah', $syubah)
        ->where('holaqoh', $tausiyah->holaqoh)
        ->get();

        $absensi = Absensi::where('tausiyah_id', $tausiyah->id)->with('member')->get();

        // Hitung jumlah untuk masing-masing status
        $jumlahIzin = $absensi->where('status', 'izin')->count();
        $jumlahTanpaKeterangan = $absensi->where('status', 'tanpa_keterangan')->count();
        $jumlahHadir = $absensi->where('status', 'hadir')->count();

        $jml = $jumlahIzin + $jumlahTanpaKeterangan;
        $jwh = $jumlahHadir + $jumlahIzin + $jumlahTanpaKeterangan;

        $persentase_absensi = $jwh > 0 ? round(($jml / $jwh) * 100, 2) : 0;

        $data = array(
            "title" => "Detail Tausiyah & Kehadiran",
            "menuJamiahLaporan" => "menu-open",
            "tausiyah" => $tausiyah,
            "members" => $members,
            "absensi" => $absensi,
            'syubah' => $syubah,
            "persentase_absensi" => $persentase_absensi,
        );

        return view('jamiah.show', $data);
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
        //
    }

    public function perIndividu(Request $request)
    {
        // Validasi input tahun (format YYYY)
        $tahun = $request->input('tahun', date('Y'));
        if (!preg_match('/^\d{4}$/', $tahun)) {
            $tahun = date('Y');
        }

        // Validasi input bulan (format 01-12)
        $bulan = $request->input('bulan', date('m'));
        if (!preg_match('/^(0[1-9]|1[0-2])$/', $bulan)) {
            $bulan = date('m');
        }

        // Ambil syubah dari input, default dari user login
        $syubah = $request->input('syubah', auth()->user()->syubah);

        // Ambil list syubah unik dari user untuk dropdown filter
        $listSyubah = \App\Models\User::select('syubah')->distinct()->orderBy('syubah')->pluck('syubah');

        // Ambil anggota Member berdasarkan filter syubah, urut berdasarkan kolom 'name' (ganti kalau beda)
        $members = Member::when($syubah, function($query, $syubah) {
                return $query->where('syubah', $syubah);
            })
            ->orderBy('name')  // sesuaikan kolom nama
            ->get();

        $rekap = [];

        foreach ($members as $member) {
            // Ambil absensi member dengan filter tahun & bulan pada kolom created_at (ganti kolom ini kalau beda)
            $absensis = Absensi::where('member_id', $member->id)
                ->whereYear('created_at', $tahun)
                ->whereMonth('created_at', $bulan)
                ->get();

            // Hitung jumlah status kehadiran
            $jumlah_hadir = $absensis->where('status', 'hadir')->count();
            $jumlah_izin = $absensis->where('status', 'izin')->count();
            $jumlah_tanpa_keterangan = $absensis->where('status', 'tanpa_keterangan')->count();
            $total = $jumlah_izin + $jumlah_tanpa_keterangan;
            $jwh = $jumlah_hadir + $jumlah_izin + $jumlah_tanpa_keterangan;
            $jml = $jumlah_izin + $jumlah_tanpa_keterangan;

            // Hitung persentase kehadiran
            $persentase = $jml > 0 ? round(($jml / $jwh) * 100, 2) : 0;

            $rekap[] = [
                'member' => $member,
                'hadir' => $jumlah_hadir,
                'izin' => $jumlah_izin,
                'tanpa_keterangan' => $jumlah_tanpa_keterangan,
                'total' => $total,
                'persentase' => $persentase,
            ];
        }

        $syubahOptions = ['AshShidiqqin', 'AsySyuhada', 'AshSholihin', 'AlMutaqien', 'AlMuhsinin', 'AshShobirin'];

        // Kirim data ke view untuk ditampilkan
        return view('jamiah.perindividu', [
            'title' => 'Rekap Tausiyah Per Individu',
            'menuJamiahLaporan' => 'menu-open',
            'rekap' => $rekap,
            'filter_tahun' => $tahun,
            'filter_bulan' => $bulan,
            'filter_syubah' => $syubah,
            'syubahOptions' => $syubahOptions,
        ]);
    }

    public function exportPdf(Request $request)
    {
        $syubah = $request->input('syubah');

        $tausiyah = Tausiyah::with('user')
            ->when($syubah, function ($query) use ($syubah) {
                $query->whereHas('user', function ($q) use ($syubah) {
                    $q->where('syubah', $syubah);
                });
            })
            ->orderBy('created_at', 'desc')
            ->get();

        $pdf = Pdf::loadView('jamiah.export', [
            'title' => 'Laporan Tausiyah',
            'tausiyah' => $tausiyah
        ]);
        
        return $pdf->download('laporan_tausiyah.pdf');
    }
}
