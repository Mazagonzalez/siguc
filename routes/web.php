<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UploadInvoice;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    /* Ruta para user */
    require __DIR__.'/User.php';
});

Route::get('/download-invoice/{id}', [UploadInvoice::class, 'getInvoice'])->name('download.invoice');

