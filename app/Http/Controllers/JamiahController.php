<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Absensi;
use App\Models\Holaqoh;
use App\Models\Pengisi;
use App\Models\Tausiyah;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class JamiahController extends Controller
{
        private function gregorianToHijri($time = null)
    {
        if ($time === null) {
            $time = time();
        }

        list($m, $d, $y) = explode('-', date('m-d-Y', $time));

        $jd = gregoriantojd($m, $d, $y);
        $l = $jd - 1948440 + 10632;
        $n = intdiv($l - 1, 10631);
        $l = $l - 10631 * $n + 354;
        $j = (int)((10985 - $l) / 5316) * (int)(50 * $l / 17719) 
            + (int)($l / 5670) * (int)(43 * $l / 15238);
        $l = $l - (int)((30 - $j) / 15) * (int)(17719 * $j / 50) 
            - (int)($j / 16) * (int)(15238 * $j / 43) + 29;
        $m = (int)(24 * $l / 709);
        $d = $l - (int)(709 * $m / 24);
        $y = 30 * $n + $j - 30;

        $bulanHijriyah = [
            1 => 'Muharram',
            2 => 'Safar',
            3 => 'Rabiul Awwal',
            4 => 'Rabiul Akhir',
            5 => 'Jumadil Ula',
            6 => 'Jumadil Akhir',
            7 => 'Rajab',
            8 => 'Sya\'ban',
            9 => 'Ramadhan',
            10 => 'Syawal',
            11 => 'Dzulqaidah',
            12 => 'Dzulhijjah'
        ];

        return [
            'bulan' => $bulanHijriyah[$m],
            'tahun' => $y
        ];
    }
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

        $tausiyah = Tausiyah::with(['user', 'holaqoh', 'pengisi'])
            ->when($syubah, function ($query) use ($syubah) {
                $query->whereHas('user', function ($q) use ($syubah) {
                    $q->where('syubah', $syubah);
                });
            })
            ->orderBy('created_at', 'desc')
            ->get();

            return view('jamiah.index', [
                'title' => 'Rekap Tausiyah Per Liqo',
                'menuJamiahLaporan' => 'menu-open',
                'subMenuPerLiqo' => 'active',
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
        $tahun = $request->input('tahun');
        if (!$tahun || !preg_match('/^\d{4}$/', $tahun)) {
            // If no year is provided or invalid, use the year of the latest attendance record
            $latestAbsensi = Absensi::orderBy('created_at', 'desc')->first();
            $tahun = $latestAbsensi ? date('Y', strtotime($latestAbsensi->created_at)) : date('Y');
        }

        // Validasi input bulan (format 01-12)
        $bulan = $request->input('bulan');
        if (!$bulan || !preg_match('/^(0[1-9]|1[0-2])$/', $bulan)) {
            // If no month is provided or invalid, use the month of the latest attendance record
            $latestAbsensi = Absensi::orderBy('created_at', 'desc')->first();
            $bulan = $latestAbsensi ? date('m', strtotime($latestAbsensi->created_at)) : date('m');
        }

        // Menampilkan default seluruh umat
        $syubah = $request->input('syubah');

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
            $jumlah_sakit = $absensis->where('status', 'sakit')->count();
            $jumlah_tanpa_keterangan = $absensis->where('status', 'tanpa_keterangan')->count();
            
            // Total absensi (izin + tanpa keterangan)
            $total = $jumlah_izin + $jumlah_tanpa_keterangan;
            
            // Jumlah wajib hadir (hadir + izin + sakit + tanpa keterangan)
            $jwh = $jumlah_hadir + $jumlah_izin + $jumlah_sakit + $jumlah_tanpa_keterangan;
            
            // Jumlah absen (izin + tanpa keterangan)
            $jml = $jumlah_izin + $jumlah_tanpa_keterangan;

            // Hitung persentase kehadiran (absen / wajib hadir * 100)
            $persentase = $jwh > 0 ? round(($jml / $jwh) * 100, 2) : 0;

            $rekap[] = [
                'member' => $member,
                'hadir' => $jumlah_hadir,
                'izin' => $jumlah_izin,
                'sakit' => $jumlah_sakit,
                'tanpa_keterangan' => $jumlah_tanpa_keterangan,
                'total' => $total,
                'persentase' => $persentase,
            ];
        }

        $tahun = $request->filled('tahun') ? $request->input('tahun') : $tahun;
        $bulan = $request->filled('bulan') ? $request->input('bulan') : $bulan;
        $syubah = $request->filled('syubah') ? $request->input('syubah') : null;
        
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
        $query = Tausiyah::with(['user', 'holaqoh']);

        if ($request->filled('syubah')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('syubah', $request->syubah);
            });
        }

        $tausiyahs = $query->get();

        // Rekapitulasi Halaqoh Reguler Berdasarkan Data Nyata
        $halaqohReguler = $tausiyahs->groupBy('holaqoh.kode_holaqoh')->map(function ($group, $kode) {
            $totalAhlu = 0;
            $totalLiqo = $group->count();
            $totalIzin = 0;
            $totalTanpaIzin = 0;
            $totalHadir = 0;
            $totalWajib = 0;

            foreach ($group as $tausiyah) {
                // Hitung jumlah ahlu dari detail_holaqoh
                $ahluIds = DB::table('detail_holaqoh')
                    ->where('holaqoh_id', $tausiyah->holaqoh_id)
                    ->pluck('member_id');

                $jmlAhlu = $ahluIds->count();
                $totalAhlu = $jmlAhlu; // asumsi sama untuk semua liqo di grup

                // Ambil absensi
                $absensi = Absensi::where('tausiyah_id', $tausiyah->id)->get();

                $izin = $absensi->where('status', 'izin')->count();
                $tanpaIzin = $absensi->where('status', 'tanpa_keterangan')->count();
                $hadir = $absensi->where('status', 'hadir')->count();
                $sakit = $absensi->where('status', 'sakit')->count();

                // Jumlah wajib hadir = (jumlah ahlu * jumlah liqo) - jumlah sakit
                $wajib = ($jmlAhlu * 1) - $sakit;

                $totalIzin += $izin;
                $totalTanpaIzin += $tanpaIzin;
                $totalHadir += $hadir;
                $totalWajib += $wajib;
            }

            $totalAbsen = $totalIzin + $totalTanpaIzin;
            $persentase = $totalWajib > 0 ? number_format(($totalAbsen / $totalWajib) * 100, 2) : 0;

            // Hitung jumlah sakit total
            $totalSakit = 0;
            foreach ($group as $tausiyah) {
                $absensi = Absensi::where('tausiyah_id', $tausiyah->id)->get();
                $sakit = $absensi->where('status', 'sakit')->count();
                $totalSakit += $sakit;
            }
            
            return [
                'kode' => $kode,
                'jumlah_ahlu' => $totalAhlu,
                'jumlah_liqo' => $totalLiqo,
                'jumlah_wajib' => $totalWajib,
                'izin' => $totalIzin,
                'tanpa_izin' => $totalTanpaIzin,
                'sakit' => $totalSakit,
                'absen_total' => $totalAbsen,
                'jumlah' => $totalHadir,
                'persentase' => $persentase,
            ];
        })->values();

        // Get the syubah filter value
        $syubahFilter = $request->input('syubah');

        // Calculate new attendance recap data
        // Terjadwal: Count of pengisi with status syubah/jamiah with same syubah id based on filter
        $terjadwalSyubah = Pengisi::where('status', 'syubah')
            ->when($syubahFilter, function ($query) use ($syubahFilter) {
                $query->where('syubah', $syubahFilter);
            })
            ->count();
            
        $terjadwalJamiah = Pengisi::where('status', 'jamiah')
            ->when($syubahFilter, function ($query) use ($syubahFilter) {
                $query->where('syubah', $syubahFilter);
            })
            ->count();
            
        $terjadwalTotal = $terjadwalSyubah + $terjadwalJamiah;

        // Get all tausiyah IDs for the filtered syubah
        $tausiyahIds = $tausiyahs->pluck('id');

        // Hadir: Count of pengisi with status syubah/jamiah that exist in absensi
        $hadirSyubah = Pengisi::where('status', 'syubah')
            ->when($syubahFilter, function ($query) use ($syubahFilter) {
                $query->where('syubah', $syubahFilter);
            })
            ->whereHas('tausiyahs', function ($query) use ($tausiyahIds) {
                $query->whereIn('id', $tausiyahIds);
            })
            ->count();
            
        $hadirJamiah = Pengisi::where('status', 'jamiah')
            ->when($syubahFilter, function ($query) use ($syubahFilter) {
                $query->where('syubah', $syubahFilter);
            })
            ->whereHas('tausiyahs', function ($query) use ($tausiyahIds) {
                $query->whereIn('id', $tausiyahIds);
            })
            ->count();
            
        $hadirTotal = $hadirSyubah + $hadirJamiah;

        // Absen: Count of pengisi with status syubah/jamiah that do NOT exist in absensi
        $absenSyubah = $terjadwalSyubah - $hadirSyubah;
        $absenJamiah = $terjadwalJamiah - $hadirJamiah;
        $absenTotal = $absenSyubah + $absenJamiah;

        // Percentage: Absen rows divided by Terjadwal rows
        $percentageSyubah = $terjadwalSyubah > 0 ? number_format(($absenSyubah / $terjadwalSyubah) * 100, 2) : 0;
        $percentageJamiah = $terjadwalJamiah > 0 ? number_format(($absenJamiah / $terjadwalJamiah) * 100, 2) : 0;
        $percentageTotal = $terjadwalTotal > 0 ? number_format(($absenTotal / $terjadwalTotal) * 100, 2) : 0;

        // Prepare the new data structure for the view
        $attendanceRecap = [
            'terjadwal' => [
                'syubah' => $terjadwalSyubah,
                'jamiah' => $terjadwalJamiah,
                'total' => $terjadwalTotal
            ],
            'hadir' => [
                'syubah' => $hadirSyubah,
                'jamiah' => $hadirJamiah,
                'total' => $hadirTotal
            ],
            'absen' => [
                'syubah' => $absenSyubah,
                'jamiah' => $absenJamiah,
                'total' => $absenTotal
            ],
            'percentage' => [
                'syubah' => $percentageSyubah,
                'jamiah' => $percentageJamiah,
                'total' => $percentageTotal
            ]
        ];

        // =======================
        // Data Lain Bisa Disesuaikan
        // =======================
        
        // Simulasi Rekap Mudzakkir (ubah jika punya struktur relasi sebenarnya)
        $dataMudzakkir = [
            'syubah' => $terjadwalSyubah,
            'jamiah' => $terjadwalJamiah,
            'total' => $terjadwalTotal,
            'frekuensi' => 'MJ01(1x), MJ02(2x)',
            'terjadwal' => $terjadwalTotal,
            'hadir' => $hadirTotal,
            'absen' => $absenTotal,
            'persentase' => $percentageTotal
        ];

        // Simulasi Gabungan (jika ada data nyata bisa ganti)
        // $halaqohGabungan = collect([
        //     [
        //         'segmen' => 'Gabungan 1',
        //         'jumlah_ahlu' => 30,
        //         'jumlah_liqo' => 2,
        //         'jumlah_wajib' => 60,
        //         'izin' => 3,
        //         'tanpa_izin' => 1,
        //         'jumlah' => 56,
        //         'persentase' => 6.67,
        //     ],
        //     [
        //         'segmen' => 'Gabungan 2',
        //         'jumlah_ahlu' => 25,
        //         'jumlah_liqo' => 2,
        //         'jumlah_wajib' => 50,
        //         'izin' => 2,
        //         'tanpa_izin' => 2,
        //         'jumlah' => 46,
        //         'persentase' => 8.00,
        //     ]
        // ]);
        $hijri = $this->gregorianToHijri(); 
        $bulan = $hijri['bulan'];
        $tahun = $hijri['tahun'];

        $pdf = Pdf::loadView('jamiah.export', [
            'title' => 'Rekap Tausiyah',
            'tausiyahs' => $tausiyahs,
            'halaqohReguler' => $halaqohReguler,
            'attendanceRecap' => $attendanceRecap,
            'dataMudzakkir' => $dataMudzakkir,
            // 'halaqohGabungan' => $halaqohGabungan,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'syubah' => $syubahFilter
        ])->setPaper('a4', 'portrait');

        return $pdf->download('rekap_tausiyah.pdf');
    }
   
}