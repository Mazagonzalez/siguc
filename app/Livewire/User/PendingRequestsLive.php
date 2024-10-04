<?php

namespace App\Livewire\User;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Request;
use Livewire\Component;
use App\Models\Provider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class PendingRequestsLive extends Component
{
    public $requests = [];

    protected $listeners = ['request' => 'mount'];

    public function mount()
    {
        if (Auth::check()) {
            $this->requests = Request::where('user_id', Auth::id())->whereIn('status', [0, 1])->where('double_order', 0)->orderBy('status', 'desc')->get();
        } else {
            $this->requests = [];
        }
    }

    public function confirmDelivery($requestId)
    {
        $request = Request::find($requestId);
        $request->update([
            'status' => 3,
            'date_loading' => Carbon::now()->toDateTimeString(),
        ]);
        $this->dispatch('request');

        if ($request->id_request_double) {
            $requestDouble = Request::find($request->id_request_double);
            $requestDouble->update([
                'status' => 3,
                'date_loading' => Carbon::now()->toDateTimeString(),
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
    }

    public function render()
    {
        return view('livewire.user.pending-requests-live', ['requests' => $this->requests]);
    }
}
