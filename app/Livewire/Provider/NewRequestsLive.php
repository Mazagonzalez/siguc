<?php

namespace App\Livewire\Provider;

use App\Models\History;
use App\Models\Provider;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class NewRequestsLive extends Component
{
    public $totalRequests = [];

    protected $listeners = ['request-new' => 'mount'];

    public function mount()
    {
        if (Auth::check()) {
            $provider = Provider::where('user_id', Auth::id())->first();
            $this->totalRequests = History::where('provider_id', $provider->id)
                ->where('status', 0)
                ->orderBy('created_at', 'asc')
                ->get();
        } else {
            $this->totalRequests = [];
        }
    }

    public function render()
    {
        return view('livewire.provider.new-requests-live', ['totalRequests' => $this->totalRequests]);
    }
}
