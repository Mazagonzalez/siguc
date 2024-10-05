<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class RequestExport implements FromView, ShouldAutoSize
{
    use Exportable;

    protected $request;

    public function __construct($request = null)
    {
        $this->request = $request;
    }

    public function view(): View
    {
        return view('exports.request-export', [
            'request' => $this->request,
        ]);
    }
}
