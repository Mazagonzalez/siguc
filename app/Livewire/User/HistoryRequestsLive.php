<?php

namespace App\Livewire\User;

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
            $this->requests = Request::where('user_id', Auth::id())->where('status', 3)->orderBy('updated_at', 'desc')->get();
        } else {
            $this->requests = [];
        }
    }

    public function render()
    {
        return view('livewire.user.history-requests-live', ['requests' => $this->requests]);
    }
}
