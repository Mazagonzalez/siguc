<?php

namespace App\Livewire\User\Exportation;

use Livewire\Component;
use App\Models\Proforma;
use App\Models\Provider;
use App\Models\RequestExportation;
use Illuminate\Support\Facades\Auth;

class DetailsRequestLive extends Component
{
    public $open = false;

    public $request;

    public $providers = [];

    public $detailProforma = false;

    public function mount(RequestExportation $request)
    {
        $this->request = $request;
        $provider = Provider::where('user_id', Auth::id())->first();
        $this->providers = Proforma::where('proforma_id', $this->request->proforma_id)->where('provider_id',$provider->id)->get();
    }

    public function showModal()
    {
        $this->open = true;
    }

    public function activeDetailProforma()
    {
        $this->detailProforma = !$this->detailProforma;
    }

    public function close()
    {
        $this->open = false;
    }

    public function downloadInvoice()
    {
        return redirect()->route('download.invoice', ['id' => $this->request->id]);
    }

    public function render()
    {
        return view('livewire.user.exportation.details-request-live');
    }
}
