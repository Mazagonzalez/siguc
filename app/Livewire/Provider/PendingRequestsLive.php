<?php

namespace App\Livewire\Provider;

use App\Models\User;
use app\Models\Users;
use App\Models\Request;
use Livewire\Component;
use App\Models\Provider;
use Illuminate\Support\Facades\Auth;

class PendingRequestsLive extends Component
{
    public $requests = [];

    protected $listeners = ['request' => 'mount'];

    public function mount()
    {
        if (Auth::check()) {
            $idUser = User::find(Auth::id());
            $provider = Provider::where('company_name', $idUser->name)->first();
            $this->requests = Request::where('provider_id', $provider->id)->where('status',1)->get();
        } else {
            $this->requests = [];
        }
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
