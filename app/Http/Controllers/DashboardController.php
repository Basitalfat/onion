<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Member;
use App\Models\Holaqoh;
use App\Models\Pengisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $usersPerDay = DB::table('users')
        ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as total'))
        ->groupBy('date')
        ->orderBy('date', 'ASC')
        ->get();

        // Get member counts grouped by syubah
        $membersBySyubah = Member::select('syubah', DB::raw('count(*) as total'))
            ->groupBy('syubah')
            ->get();

        $data = array(
            "title" => "Dashboard",
            "menuAdminDashboard" => "menu-open",
            "jumlahAdmin" =>User::where('role', 'admin')->count(),
            "jumlahPengguna" =>User::whereNot('role', 'admin')->count(),
            "jumlahMember" =>Member::all()->count(),
            "membersBySyubah" => $membersBySyubah,
            "usersPerDay" => $usersPerDay
        );
        return view('dashboard', $data);
    }

    public function create()
    {
        $data = array(
            "title" => "Absensi tausiyah",
            "menuAdminDashboard" => "menu-open",
            "holaqohs" => Holaqoh::all(),
            "pengisi" => Pengisi::orderBy('name', 'asc')->get(),
        );
        
        return view('mudir.dashboard.create', $data);
    }
   
}