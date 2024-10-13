<?php

namespace App\Livewire\Provider;

use App\Models\History;
use Livewire\Component;
use App\Models\Provider;
use Illuminate\Support\Facades\Auth;

class HistoryRequestsLive extends Component
{
    public $totalRequests = [];

    protected $listeners = ['request' => 'mount'];

    public function mount()
    {
        if (Auth::check()) {
            $provider = Provider::where('user_id', Auth::id())->first();
            $this->totalRequests = History::where('provider_id', $provider->id)
            ->whereIn('status', [2, 5])
            ->orderBy('created_at', 'asc')
            ->get();
        } else {
            $this->totalRequests = [];
        }
    }

    public function render()
    {
        return view('livewire.provider.history-requests-live', ['totalRequests' => $this->totalRequests]);
    }
}
