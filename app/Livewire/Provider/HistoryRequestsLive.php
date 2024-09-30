<?php

namespace App\Livewire\Provider;

use App\Models\Request;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class HistoryRequestsLive extends Component
{
    public $requests = [];

    public function mount()
    {
        if (Auth::check()) {
            $this->requests = Request::where('provider_id', Auth::id())->whereIn('status', [2, 3])->get();
        } else {
            $this->requests = [];
        }
    }

    public function render()
    {
        return view('livewire.provider.history-requests-live', ['requests' => $this->requests]);
    }
}
