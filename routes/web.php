<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\JamiahController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TausiyahController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DetailHolaqohController;
use App\Http\Controllers\HolaqohController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

    Route::middleware('auth')->group(function () {

    Route::resource('user', UserController::class);
    Route::get('member/import', [MemberController::class, 'showImportForm'])->name('member.import.form');
    Route::post('member/import', [MemberController::class, 'import'])->name('member.import');
    Route::resource('tausiyah', TausiyahController::class);
    Route::resource('absensi', AbsensiController::class);
    Route::resource('member', MemberController::class);
    Route::resource('holaqoh', HolaqohController::class);
    Route::resource('jamiah', JamiahController::class);


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('/export-pdf/user', [PDFController::class, 'export'])->name('userPdf');
    Route::get('/export-pdf/member', [PDFController::class, 'memberexport'])->name('memberPdf');
    Route::get('/rekap/perliqo', [JamiahController::class, 'perLiqo'])->name('rekap.perliqo');
    Route::get('/rekap/perindividu', [JamiahController::class, 'perIndividu'])->name('rekap.perindividu');
    Route::get('/rekap/export-pdf', [JamiahController::class, 'exportPdf'])->name('jamiah.exportPdf');

    Route::get('/detail-halaqoh/{id}', [DetailHolaqohController::class, 'show']);
    Route::post('/detail-halaqoh', [DetailHolaqohController::class, 'store'])->name('detail-halaqoh.store');
    Route::get('/api/detail-halaqoh/{id}', [DetailHolaqohController::class, 'show']);

});

require __DIR__.'/auth.php';
