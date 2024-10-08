<?php

namespace App\Http\Controllers;

use App\Models\Request;
use App\Exports\RequestExport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request as HttpRequest;

class ExportController extends Controller
{
    public function excelRequest(HttpRequest $request)
    {
        $requestExpor = Request::where('user_id', Auth::id())->whereIn('status', [2, 4])->orderBy('updated_at', 'desc');

        if (!is_null($request->start_date) and !is_null($request->end_date) and $request->end_date >= $request->start_date) {
            $requestExpor = $requestExpor->whereBetween(
                'created_at',
                [$request->start_date . ' 00:00:00', $request->end_date . ' 23:59:59']
            );
        }

        if ($request->statu == 1) {
            $requestExpor = $requestExpor->where('status', 4);
        }
        if ($request->statu == 2) {
            $requestExpor = $requestExpor->where('status', 2);
        }
        $requestExpor = $requestExpor->get();

        return (new RequestExport($requestExpor))->download('solicitudes.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }
}

