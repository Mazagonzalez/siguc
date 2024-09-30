<?php

namespace App\Livewire\Provider;

use app\Models\Users;
use App\Models\Request;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class PendingRequestsLive extends Component
{
    public $requests = [];

    protected $listeners = ['request' => 'mount'];

    public function mount()
    {
        if (Auth::check()) {
            $this->requests = Request::where('provider_id', Auth::id())->where('status',1)->get();
        } else {
            $this->requests = [];
        }
    }

    public function showRequest($requestId)
    {
        //modal de detalles
    }

    public function rejectRequest($requestId)
    {
        $request = Request::find($requestId);
        $request->status = 2;
        $request->save();
        $this->requests = Request::where('provider_id', Auth::id())->where('status',1)->get();
        $this->dispatch('request');
    }

    public function render()
    {
        return view('livewire.provider.pending-requests-live', ['requests' => $this->requests]);
    }
}
