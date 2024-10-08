<?php

namespace App\Livewire\User;

use App\Models\Request;
use App\Models\RequestThermoformed;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Http;

class DashboardLive extends Component
{
    public $request_acepted;
    public $request_pending;
    public $request_rejected;
    public $request_finished;
    public $request_nationales;
    public $request_thermoformed;

    protected $listeners = ['request' => 'mount'];

    public function mount()
    {
        $this->totalRequest();
    }

    public function totalRequest()
    {
        $request_aceptedN = Request::where('status', 1)->where('double_order', 0)->count();
        $request_pendingN = Request::where('status', 0)->where('double_order', 0)->count();
        $request_rejectedN = Request::where('status', 2)->where('double_order', 0)->count();
        $request_finishedN = Request::where('status', 4)->where('double_order', 0)->count();
        $request_aceptedT = RequestThermoformed::where('status', 1)->count();
        $request_pendingT = RequestThermoformed::where('status', 0)->count();
        $request_rejectedT = RequestThermoformed::where('status', 2)->count();
        $request_finishedT = RequestThermoformed::where('status', 4)->count();

        $this->request_acepted = $request_aceptedN + $request_aceptedT;
        $this->request_pending = $request_pendingN + $request_pendingT;
        $this->request_rejected = $request_rejectedN + $request_rejectedT;
        $this->request_finished = $request_finishedN + $request_finishedT;

        $this->request_nationales = Request::where('status', 4)->where('double_order', 0)->count();
        $this->request_thermoformed = RequestThermoformed::where('status', 4)->count();
    }

    public function render()
    {
        return view('livewire.user.dashboard-live');
    }
}
