<?php

namespace App\Livewire\Provider;

use App\Models\User;
use App\Models\Request;
use Livewire\Component;
use App\Models\Provider;
use Illuminate\Support\Facades\Auth;

class HistoryRequestsLive extends Component
{
    public $requests = [];

    protected $listeners = ['request' => 'mount'];

    public function mount()
    {
        if (Auth::check()) {
            $idUser = User::find(Auth::id());
            $provider = Provider::where('company_name', $idUser->name)->first();
            $this->requests = Request::where('provider_id', $provider->id)->whereIn('status', [2, 3])->get();
        } else {
            $this->requests = [];
        }
    }

    public function render()
    {
        return view('livewire.provider.history-requests-live', ['requests' => $this->requests]);
    }
}
