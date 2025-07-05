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
        $detail = DetailHolaqoh::with(['member', 'halaqoh'])
            ->where('member_id', (int) $id)
            ->first();

        if (!$detail) {
            return response()->json(['message' => 'Belum ada relasi'], 404);
        }

        return response()->json(['data' => $detail]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'member_id' => 'required|exists:members,id',
            'holaqoh_id' => 'required|exists:holaqohs,id',
        ]);

        \Log::info('Saving detail_halaqoh:', $validated);

        $detail = DetailHolaqoh::updateOrCreate(
            ['member_id' => $validated['member_id']],
            ['holaqoh_id' => $validated['holaqoh_id']]
        );

        $detail->load(['member', 'halaqoh']);

        return response()->json([
            'message' => 'Berhasil disimpan',
            'data' => $detail
        ]);
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
