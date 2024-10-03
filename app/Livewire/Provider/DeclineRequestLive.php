<?php

namespace App\Livewire\Provider;

use App\Models\Request;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class DeclineRequestLive extends Component
{
    public $open = false;

    public $request;

    public $decline_comment;

    public function mount(Request $request)
    {
        $this->request = $request;
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

        DB::beginTransaction();

        $this->request->update([
            'decline_comment' => $this->decline_comment,
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
        $this->reset('decline_comment');
    }

    public function close()
    {
        $this->resetRequest();
        $this->open = false;
    }

    public function render()
    {
        return view('livewire.provider.decline-request-live');
    }
}
