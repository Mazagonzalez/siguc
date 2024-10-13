<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExportController;
use App\Livewire\User\RequestNationalLive;
use App\Livewire\User\RequestExportationLive;
use App\Livewire\User\RequestThermoformedLive;

Route::get('export/excel/request', [ExportController::class, 'excelRequest'])->name('export.request');
Route::get('export/excel/history', [ExportController::class, 'excelHistory'])->name('export.history');

Route::get('/solicitudes-nacionales', RequestNationalLive::class)->name('request.national');
Route::get('/solicitudes-de-exportacion', RequestExportationLive::class)->name('request.exportation');
Route::get('/solicitudes-de-termoformado', RequestThermoformedLive::class)->name('request.thermoformed');

