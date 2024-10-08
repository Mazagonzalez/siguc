<?php

namespace App\Livewire\Provider;

use App\Models\Provider;
use App\Models\Request;
use App\Models\RequestThermoformed;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class NewRequestsLive extends Component
{
    public $requests = [];
    public $requestsThermoformed = [];

    protected $listeners = ['request' => 'mount'];

    public function mount()
    {
        if (Auth::check()) {
            $provider = Provider::where('user_id', Auth::id())->first();
            $this->requests = Request::where('provider_id', $provider->id)->where('status', 0)->where('double_order', 0)->get();
            $this->requestsThermoformed = RequestThermoformed::where('provider_id', $provider->id)->where('status', 0)->get();

            //$this->allRequests = $requests->merge($requestsThermoformed);
        } else {
            $this->requests = [];
        }
    }

    public function render()
    {
        return view('livewire.provider.new-requests-live', ['requests' => $this->requests,
            'requestsThermoformed' => $this->requestsThermoformed]);
    }
}
