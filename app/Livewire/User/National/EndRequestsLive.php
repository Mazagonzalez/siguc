<?php

namespace App\Livewire\User\National;

use App\Models\History;
use App\Models\Request;
use Livewire\Component;
use Livewire\WithPagination;
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
        $request = Request::find($requestId);
        $request->update([
            'status' => 5,
        ]);

        $history = History::where('request_id', $request->id)
                            ->where('type_request', 'Solicitud nacional')
                            ->first();
        $history->update([
            'status' => 5,
        ]);

        if ($request->id_request_double) {
            $requestDouble = Request::find($request->id_request_double);
            $requestDouble->update([
                'status' => 5,
            ]);
        }

        $objeto = json_encode(2);

        if ($requestId) {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->patch('https://sigucapi-hahdhuh9dyetd7h6.canadacentral-01.azurewebsites.net/api/OrderData/' . $request->order_number, $objeto);

            if ($request->id_request_double) {
                $response1 = Http::withHeaders([
                    'Content-Type' => 'application/json',
                ])->patch('https://sigucapi-hahdhuh9dyetd7h6.canadacentral-01.azurewebsites.net/api/OrderData/' . $requestDouble->order_number, $objeto);
            }
        }

        DB::commit();

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
        $items = Request::where('user_id', Auth::id())->where('status', 4)->where('double_order', 0)->orderBy('updated_at', 'desc');

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

        return view('livewire.user.national.end-requests-live', ['requestsCollection' => $requests]);
    }
}
