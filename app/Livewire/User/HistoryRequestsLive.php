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
            $this->requests = Request::where('user_id', Auth::id())->whereIn('status', [2, 4])->where('double_order', 0)->orderBy('updated_at', 'desc')->get();
        } else {
            $this->requests = [];
        }
    }

    public function render()
    {
        return view('livewire.user.history-requests-live', ['requests' => $this->requests]);
    }
}
