<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Mail\CompletedOrderMail;
use Illuminate\Support\Facades\Mail;

class SendConfirmLive extends Component
{
    public $open = false;

    public $request;

    public $mail;

    public $comment;

    public function mount($request)
    {
        $this->request = $request;
    }

    public function showModal()
    {
        $this->resetRequest();
        $this->open = true;
    }

    public function store()
    {
        $this->validate([
            'mail' => 'required|email',
        ],
        [
            'mail.required' => 'El campo correo es obligatorio',
            'mail.email' => 'El campo correo no es válido',
        ]);


        $mail = new CompletedOrderMail($this->request->id, $this->comment);
        Mail::to($this->mail)->queue($mail);

        $this->close();
    }

    public function resetRequest()
    {
        $this->resetErrorBag();
        $this->reset([
            'mail',
            'comment'
        ]);
    }

    public function close()
    {
        $this->resetErrorBag();
        $this->open = false;
    }

    public function render()
    {
        return view('livewire.user.send-confirm-live');
    }
}
