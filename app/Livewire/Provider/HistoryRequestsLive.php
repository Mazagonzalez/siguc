<?php

namespace App\Livewire\Provider;

use App\Models\User;
use App\Models\Request;
use Livewire\Component;
use App\Models\Provider;
use App\Models\RequestThermoformed;
use Illuminate\Support\Facades\Auth;

class HistoryRequestsLive extends Component
{
    public $requests = [];

    public $requestsThermoformed = [];

    protected $listeners = ['request' => 'mount'];

    public function mount()
    {
        if (Auth::check()) {
            $provider = Provider::where('user_id', Auth::id())->first();
            $this->requests = Request::where('provider_id', $provider->id)
                ->whereIn('status', [2, 5])
                ->where('double_order', 0)
                ->orderByRaw("FIELD(status, 5, 2) asc, updated_at desc")
                ->get();
            $this->requestsThermoformed = RequestThermoformed::where('provider_id', $provider->id)
                ->whereIn('status', [2, 5])
                ->orderByRaw("FIELD(status, 5, 2) asc, updated_at desc")
                ->get();
        } else {
            $this->requests = [];
        }
    }

    public function render()
    {
        return view('livewire.provider.history-requests-live', ['requests' => $this->requests,
                                                              'requestsThermoformed' => $this->requestsThermoformed]);
    }
}
