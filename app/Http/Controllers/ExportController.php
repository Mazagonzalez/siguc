<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Request;
use App\Exports\RequestExport;
use Illuminate\Support\Facades\Auth;
use App\Exports\HistoryDashboardExport;
use Illuminate\Http\Request as HttpRequest;

class ExportController extends Controller
{
    public function excelRequest(HttpRequest $request)
    {
        $requestExpor = Request::where('user_id', Auth::id())->whereIn('status', [2, 5])->orderBy('updated_at', 'desc');

        if (!is_null($request->start_date) and !is_null($request->end_date) and $request->end_date >= $request->start_date) {
            $requestExpor = $requestExpor->whereBetween(
                'created_at',
                [$request->start_date . ' 00:00:00', $request->end_date . ' 23:59:59']
            );
        }

        if ($request->statu == 1) {
            $requestExpor = $requestExpor->where('status', 5);
        }
        if ($request->statu == 2) {
            $requestExpor = $requestExpor->where('status', 2);
        }
        $requestExpor = $requestExpor->get();

        return (new RequestExport($requestExpor))->download('solicitudes.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }

    public function excelHistory(HttpRequest $request)
    {
        $items = History::orderBy('updated_at', 'desc');

        if (!is_null($request->start_date) and !is_null($request->end_date) and $request->end_date >= $request->start_date) {
            $items = $items->whereBetween(
                'created_at',
                [$request->start_date . ' 00:00:00', $request->end_date . ' 23:59:59']
            );
        }

        if ($request->statu == 1) {
            $items = $items->where('status', 5);
        }
        if ($request->statu == 2) {
            $items = $items->where('status', 2);
        }
        if ($request->type == 1) {
            $items = $items->where('type_request', 'Solicitud nacional');
        }
        if ($request->type == 2) {
            $items = $items->where('type_request', 'Solicitud exportacion');
        }
        if ($request->type == 3) {
            $items = $items->where('type_request', 'Solicitud termoformado');
        }

        $request = $items->get();

        return (new HistoryDashboardExport($request))->download('historial.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }
}

