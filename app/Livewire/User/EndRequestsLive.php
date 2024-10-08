<?php

namespace App\Livewire\User;

use App\Models\Request;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class EndRequestsLive extends Component
{
    public $requests = [];

    public $start_date;

    public $end_date;

    protected $listeners = ['request' => 'mount'];

    public function confirmDelivery($requestId)
    {
        $request = Request::find($requestId);
        $request->update([
            'status' => 4,
        ]);

        if ($request->id_request_double) {
            $requestDouble = Request::find($request->id_request_double);
            $requestDouble->update([
                'status' => 4,
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

        $this->dispatch('request');
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
        $items = Request::where('user_id', Auth::id())->where('status', 3)->where('double_order', 0)->orderBy('updated_at', 'desc');

        if (!is_null($this->start_date) and !is_null($this->end_date) and $this->end_date < $this->start_date) {
            $this->addError('start_date', __('La fecha inicial debe ser una fecha anterior o igual a la fecha final.'));
        }

        if (!is_null($this->start_date) and !is_null($this->end_date) and $this->end_date >= $this->start_date) {
            $items->whereBetween(
                'updated_at',
                [$this->start_date . ' 00:00:00', $this->end_date . ' 23:59:59']
            );
        }

        $requests = $items->get();

        return view('livewire.user.end-requests-live', ['requestsCollection' => $requests]);
    }
}
