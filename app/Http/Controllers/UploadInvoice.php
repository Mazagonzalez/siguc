<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class UploadInvoice extends Controller
{
    public function getInvoice($requestId)
    {
        $cacheKey = 'invoice_' . $requestId;
        $filePath = Cache::get($cacheKey);

        if ($filePath) {
            return Storage::download($filePath);
        } else {
            return response()->json(['error' => 'Archivo no encontrado o ha expirado'], 404);
        }
    }
}
