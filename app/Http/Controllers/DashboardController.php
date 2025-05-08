<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Member;
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

        $data = array(
            "title" => "Dashboard",
            "menuAdminDashboard" => "menu-open",
            "jumlahAdmin" =>User::where('role', 'admin')->count(),
            "jumlahPengguna" =>User::whereNot('role', 'admin')->count(),
            "jumlahMember" =>Member::all()->count(),
            "usersPerDay" => $usersPerDay
        );
        return view('dashboard', $data);
    }
   
}
