<?php

namespace App\Livewire\User;

use App\Models\Request;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class EndRequestsLive extends Component
{
    public $requests = [];

    protected $listeners = ['request' => 'mount'];

    public function mount()
    {
        if (Auth::check()) {
            $this->requests = Request::where('user_id', Auth::id())->where('status', 3)->where('double_order', 0)->orderBy('status', 'desc')->get();
        } else {
            $this->requests = [];
        }
    }

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

    public function render()
    {
        return view('livewire.user.end-requests-live', ['requests' => $this->requests]);
    }
}
