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
        $this->request_acepted = Request::where('status', 1)->where('double_order', 0)->count();
        $this->request_pending = Request::where('status', 0)->where('double_order', 0)->count();
        $this->request_rejected = Request::where('status', 2)->where('double_order', 0)->count();
        $this->request_finished = Request::where('status', 4)->where('double_order', 0)->count();
        $this->request_nationales = Request::where('status', 4)->where('double_order', 0)->count();
        $this->request_thermoformed = RequestThermoformed::where('status', 4)->count();
    }

    public function render()
    {
        return view('livewire.user.dashboard-live');
    }
}
