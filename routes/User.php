<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExportController;
use App\Livewire\User\RequestNationalLive;
use App\Livewire\User\RequestExporLive;
use App\Livewire\User\RequestThermoformedLive;

Route::get('export/excel/request', [ExportController::class, 'excelRequest'])->name('export.request');

Route::get('/solicitudes-nacionales', RequestNationalLive::class)->name('request.nationa');
Route::get('/solicitudes-de-exportacion', RequestExporLive::class)->name('request.export');
Route::get('/solicitudes-de-termoformado', RequestThermoformedLive::class)->name('request.thermoformed');

