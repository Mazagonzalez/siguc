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

    public $typeRequest;

    public $comment;

    /*status 1 = nacional; 2 = exportacion; 3 = termoformado */

    public function mount($request, $typeRequest)
    {
        $this->request = $request;
        $this->typeRequest = $typeRequest;
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
        $mail = new CompletedOrderMail($this->request->id, $this->comment, $this->typeRequest);
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
