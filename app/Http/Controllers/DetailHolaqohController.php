<?php

namespace App\Http\Controllers;

use App\Models\DetailHolaqoh;
use App\Models\Holaqoh;
use App\Models\Member;
use Illuminate\Http\Request;

class DetailHolaqohController extends Controller
{
    public function show($id)
    {
        $detail = DetailHolaqoh::with(['member', 'holaqoh'])
            ->where('member_id', (int) $id)
            ->first();

        if (!$detail) {
            return response()->json(['message' => 'Belum ada relasi'], 404);
        }

        return response()->json(['data' => $detail]);
    }

    public function store(Request $request)
    {
       
        $request->validate([
            'holaqoh_id' => 'required|exists:holaqohs,id',
            'member_id' => 'required|exists:members,id',
        ]);

        // Cek apakah member sudah ada di holaqoh ini
        $exists = DetailHolaqoh::where('holaqoh_id', $request->holaqoh_id)
            ->where('member_id', $request->member_id)
            ->exists();

        if ($exists) {
            return back()->with('warning', 'Member sudah terdaftar di holaqoh ini.');
        }
        // ambil syubah dari holaqoh
        $holaqoh = Holaqoh::findOrFail($request->holaqoh_id);
        // Simpan ke tabel detail_holaqoh
        DetailHolaqoh::create([
            'holaqoh_id' => $request->holaqoh_id,
            'member_id' => $request->member_id,
            'syubah'     => $holaqoh->syubah,
        ]);

        return back()->with('success', 'Member berhasil ditambahkan ke holaqoh.');
    }
    

    public function destroy($id)
    {
        $detail = DetailHolaqoh::where('member_id', $id)->first();
        if ($detail) {
            $detail->delete();
        }

        return response()->json(['message' => 'Berhasil dihapus']);
    }
}
