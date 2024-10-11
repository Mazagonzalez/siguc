<?php

namespace App\Livewire\User;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\RequestThermoformed;

class RequestThermoformedLive extends Component
{
    public $request_acepted;
    public $request_pending;
    public $request_rejected;
    public $request_finished;

    protected $listeners = ['request' => 'mount'];

    public function mount()
    {
        $this->request_acepted = RequestThermoformed::where('status', 1)->count();
        $this->request_pending = RequestThermoformed::where('status', 0)->count();
        $this->request_rejected = RequestThermoformed::where('status', 2)->count();
        $this->request_finished = RequestThermoformed::where('status', 5)->count();
    }

    #[On('successful-toast')]
    public function seeToast($message)
    {
        session()->flash('message', $message);
    }

    public function render()
    {
        return view('livewire.user.request-thermoformed-live')->layout('layouts.app');
    }
}
