<?php

namespace App\Livewire\Provider;

use App\Models\Request;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class NewRequestsLive extends Component
{
    public $requests = [];

    public function mount()
    {
        if (Auth::check()) {
            $this->requests = Request::where('provider_id', Auth::id())->where('status',0)->get();
        } else {
            $this->requests = [];
        }
    }

    public function showRequest($requestId)
    {
        //modal de detalles
    }

    public function acceptRequest($requestId)
    {
        $request = Request::find($requestId);
        $request->status = 1;
        $request->save();
        $this->requests = Request::where('provider_id', Auth::id())->where('status',0)->get();
    }

    public function rejectRequest($requestId)
    {
        $request = Request::find($requestId);
        $request->status = 2;
        $request->save();
        $this->requests = Request::where('provider_id', Auth::id())->where('status',0)->get();
    }

    public function render()
    {
        return view('livewire.provider.new-requests-live', ['requests' => $this->requests]);
    }
}
