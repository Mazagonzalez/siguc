<?php

namespace App\Livewire\User\Thermoformed;

use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\RequestThermoformed;

class DeclineRequestsLive extends Component
{
    public $open = false;

    public $request;

    public $decline_comment;

    public $roleDecline;

    public function mount(RequestThermoformed $request, $roleDecline)
    {
        $this->request = $request;
        $this->roleDecline = $roleDecline;
    }

    public function showModal()
    {
        $this->open = true;
    }

    public function store()
    {
        $this->validate([
            'decline_comment' => 'required',
        ],
        [
            'decline_comment.required' => 'Es obligatorio que llene el comentario para rechazar la solicitud.',
        ]);

        if ($this->roleDecline == 1) {
            $userDecline = $this->decline_comment;
            $providerDecline = null;
        } elseif ($this->roleDecline == 2) {
            $providerDecline = $this->decline_comment;
            $userDecline = null;
        }

        DB::beginTransaction();

        $this->request->update([
            'decline_comment' => $providerDecline,
            'user_decline_comment' => $userDecline,
            'date_decline' => Carbon::now()->toDateTimeString(),
            'status' => 2,
        ]);

        DB::commit();

        $this->open = false;
        $this->resetRequest();
        $this->dispatch('request');
    }

    public function resetRequest()
    {
        $this->resetErrorBag();
        $this->reset('decline_comment', 'roleDecline');
    }

    public function close()
    {
        $this->resetRequest();
        $this->open = false;
    }

    public function render()
    {
        return view('livewire.user.thermoformed.decline-requests-live');
    }
}
