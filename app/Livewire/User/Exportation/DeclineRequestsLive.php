<?php

namespace App\Livewire\User\Exportation;

use Carbon\Carbon;
use App\Models\History;
use Livewire\Component;
use App\Models\Proforma;
use App\Models\RequestExportation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class DeclineRequestsLive extends Component
{
    public $open = false;

    public $request;

    public $proformas;

    public $decline_comment;

    public $roleDecline;

    public function mount(RequestExportation $request, $roleDecline)
    {
        $this->request = $request;
        $this->roleDecline = $roleDecline;
        $this->proformas = Proforma::where('proforma_id', $request->proforma_id)->get();//agregar validacion
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

        $history = History::where('request_exportation_id', $this->request->id)
                            ->where('type_request', 'Solicitud exportacion')
                            ->first();

        DB::beginTransaction();

        $this->request->update([
            'decline_comment' => $providerDecline,
            'user_decline_comment' => $userDecline,
            'date_decline' => Carbon::now()->toDateTimeString(),
            'status' => 2,
        ]);

        foreach ($this->proformas as $proforma) {
            $proforma->update([
                'status' => 2,
            ]);
        }

        $history->update([
            'status' => 2,
        ]);

        DB::commit();

        // Cambia el estado en el EndPoint
       $objeto = json_encode(0);

       if ($this->request->proforma_id) {
           $response = Http::withHeaders([
               'Content-Type' => 'application/json',
           ])->patch('https://sigucapi-hahdhuh9dyetd7h6.canadacentral-01.azurewebsites.net/api/Proforma/' . $this->request->proforma_id, $objeto);
       }

        $this->open = false;
        $this->resetRequest();
        $this->dispatch('request-history');
        $this->dispatch('request');
        $this->dispatch('request-new');
        $this->dispatch('request-pending');
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
        return view('livewire.user.exportation.decline-requests-live');
    }
}
