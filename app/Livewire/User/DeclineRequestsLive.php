<?php

namespace App\Livewire\User;

use Carbon\Carbon;
use App\Models\Request;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class DeclineRequestsLive extends Component
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
            'decline_comment_user' => $this->decline_comment,
            'date_decline' => Carbon::now()->toDateTimeString(),
            'status' => 2,
        ]);

        if ($this->request->id_request_double) {
            $this->request->request_double->update([
                'decline_comment_user' => $this->decline_comment,
                'date_decline' => Carbon::now()->toDateTimeString(),
                'status' => 2,
            ]);
        }

        DB::commit();

        // Cambia el estado en el EndPoint
        $objeto = json_encode(0);

        if ($this->request->order_number) {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->patch('https://sigucapi-hahdhuh9dyetd7h6.canadacentral-01.azurewebsites.net/api/OrderData/' . $this->request->order_number, $objeto);

            if ($this->request->id_request_double) {
                $response1 = Http::withHeaders([
                    'Content-Type' => 'application/json',
                ])->patch('https://sigucapi-hahdhuh9dyetd7h6.canadacentral-01.azurewebsites.net/api/OrderData/' . $this->request->request_double->order_number, $objeto);
            }
        }

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
        return view('livewire.user.decline-requests-live');
    }
}
