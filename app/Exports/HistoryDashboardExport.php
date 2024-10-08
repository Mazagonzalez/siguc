<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class HistoryDashboardExport implements FromView, ShouldAutoSize
{
    use Exportable;

    protected $request;

    public function __construct($request = null)
    {
        $this->request = $request;
    }

    public function view(): View
    {
        Log::info("sirve". $this->request);
        return view('exports.history-dashboard-export', [
            'request' => $this->request,
        ]);
    }
}

