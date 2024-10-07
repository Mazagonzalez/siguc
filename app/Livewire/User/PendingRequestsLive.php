<?php

namespace App\Livewire\User;

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
            $this->requests = Request::where('user_id', Auth::id())->whereIn('status', [0, 1])->where('double_order', 0)->orderBy('status', 'desc')->get();
        } else {
            $this->requests = [];
        }
    }

    public function render()
    {
        return view('livewire.user.pending-requests-live', ['requests' => $this->requests]);
    }
}
