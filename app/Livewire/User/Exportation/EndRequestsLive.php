<?php

namespace App\Livewire\User\Exportation;

use App\Models\History;
use Livewire\Component;
use App\Models\Proforma;
use Livewire\WithPagination;
use App\Models\RequestExportation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class EndRequestsLive extends Component
{
    use WithPagination;

    public $requests = [];
    public $start_date;
    public $end_date;

    protected $listeners = ['request-end' => 'mount'];

    public function confirmDelivery($requestId)
    {
        DB::beginTransaction();

        $request = RequestExportation::find($requestId);
        $request->update([
            'status' => 5,
        ]);

        $history = History::where('request_exportation_id', $request->id)
                            ->where('type_request', 'Solicitud exportacion')
                            ->first();

        $history->update([
            'status' => 5,
        ]);

        $proformas = Proforma::where('proforma_id', $request->proforma_id)->get();

        foreach ($proformas as $proforma) {
            $proforma->update([
                'status' => 5,
            ]);
        }

        DB::commit();

        // Cambia el estado en el EndPoint
       $objeto = json_encode(2);

       if ($request->proforma_id) {
           $response = Http::withHeaders([
               'Content-Type' => 'application/json',
           ])->patch('https://sigucapi-hahdhuh9dyetd7h6.canadacentral-01.azurewebsites.net/api/Proforma/' . $request->proforma_id, $objeto);
       }

       $this->dispatch('request-end');
       $this->dispatch('request-history');
    }

    public function closeModalExport()
    {
        $this->reset([
            'start_date',
            'end_date',
        ]);
        $this->resetErrorBag();
    }

    public function resetAllExport()
    {
        $this->reset([
            'start_date',
            'end_date',
        ]);

        $this->resetErrorBag();
    }

    public function render()
    {
        $items = RequestExportation::where('user_id', Auth::id())->where('status', 4)->orderBy('updated_at', 'desc');

        if (!is_null($this->start_date) and !is_null($this->end_date) and $this->end_date < $this->start_date) {
            $this->addError('start_date', __('La fecha inicial debe ser una fecha anterior o igual a la fecha final.'));
        }

        if (!is_null($this->start_date) and !is_null($this->end_date) and $this->end_date >= $this->start_date) {
            $items->whereBetween(
                'updated_at',
                [$this->start_date . ' 00:00:00', $this->end_date . ' 23:59:59']
            );
        }

        $requests = $items->paginate(5);

        return view('livewire.user.exportation.end-requests-live', ['requestsCollection' => $requests]);
    }
}
