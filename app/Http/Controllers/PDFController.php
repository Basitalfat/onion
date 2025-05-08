<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Member;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{
    public function export()
    {
        $filename = now()->format('d-m-Y_H.i.s');
        $data = [ // data yang mau dikirim ke view
            'user' => User::OrderBy('role','asc')->get(),
            'tanggal' => now()->format('d-m-Y'),
            'jam' => now()->format('H.i.s'),
        ];

        $pdf = Pdf::loadView('admin.user.pdf', $data);
        return $pdf->setPaper('a4', 'landscape')->stream('DataUser_'.$filename.'.pdf');
    }

    public function memberexport()
    {
        $filename = now()->format('d-m-Y_H.i.s');
        $data = [ // data yang mau dikirim ke view
            'member' => Member::OrderBy('name','asc')->get(),
            'tanggal' => now()->format('d-m-Y'),
            'jam' => now()->format('H.i.s'),
        ];

        $pdf = Pdf::loadView('admin.member.pdf', $data);
        return $pdf->setPaper('a4', 'landscape')->stream('DataMember_'.$filename.'.pdf');
    }
}
