<?php

namespace App\Livewire\Provider;

use App\Models\User;
use app\Models\Users;
use App\Models\Request;
use Livewire\Component;
use App\Models\Provider;
use App\Models\RequestThermoformed;
use Illuminate\Support\Facades\Auth;

class PendingRequestsLive extends Component
{
    public $requests = [];
    public $requestsThermoformed = [];

    protected $listeners = ['request' => 'mount'];

    public function mount()
    {
        if (Auth::check()) {
            $provider = Provider::where('user_id', Auth::id())->first();
            $this->requests = Request::where('provider_id', $provider->id)
                ->where('status',1)
                ->where('double_order', 0)
                ->orderBy('date_quotation', 'asc')
                ->get();
            $this->requestsThermoformed = RequestThermoformed::where('provider_id', $provider->id)
                ->where('status', 1)
                ->orderBy('date_quotation', 'asc')
                ->get();
        } else {
            $this->requests = [];
        }
    }

    public function render()
    {
        return view('livewire.provider.pending-requests-live', ['requests' => $this->requests,
                                                                'requestsThermoformed' => $this->requestsThermoformed]);
    }
}
