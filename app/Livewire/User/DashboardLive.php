<?php

namespace App\Livewire\User;

use App\Models\Request;
use App\Models\RequestExportation;
use App\Models\RequestThermoformed;
use Livewire\Component;

class DashboardLive extends Component
{
    public $request_acepted;
    public $request_pending;
    public $request_rejected;
    public $request_finished;
    public $request_nationales;
    public $request_exportation;
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
        $request_finishedN = Request::where('status', 5)->where('double_order', 0)->count();
        $request_aceptedE = RequestExportation::where('status', 1)->count();
        $request_pendingE = RequestExportation::where('status', 0)->count();
        $request_rejectedE = RequestExportation::where('status', 2)->count();
        $request_finishedE = RequestExportation::where('status', 5)->count();
        $request_aceptedT = RequestThermoformed::where('status', 1)->count();
        $request_pendingT = RequestThermoformed::where('status', 0)->count();
        $request_rejectedT = RequestThermoformed::where('status', 2)->count();
        $request_finishedT = RequestThermoformed::where('status', 5)->count();



        $this->request_acepted = $request_aceptedN + $request_aceptedT + $request_aceptedE;
        $this->request_pending = $request_pendingN + $request_pendingT + $request_pendingE;
        $this->request_rejected = $request_rejectedN + $request_rejectedT + $request_rejectedE;
        $this->request_finished = $request_finishedN + $request_finishedT + $request_finishedE;

        $this->request_nationales = Request::where('status', 5)->where('double_order', 0)->count();
        $this->request_exportation = RequestExportation::where('status', 5)->count();
        $this->request_thermoformed = RequestThermoformed::where('status', 5)->count();
    }

    public function render()
    {
        return view('livewire.user.dashboard-live');
    }
}
