<?php

namespace App\Livewire\User;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\RequestExportation;
use Illuminate\Support\Facades\Http;

class RequestExportationLive extends Component
{
    public $orders;
    public $proformaId;
    public $pending = 0;
    public $request_acepted;
    public $request_pending;
    public $request_rejected;
    public $request_finished;

    protected $listeners = ['request' => 'mount'];

    public function mount()
    {
        $this->request_acepted = RequestExportation::where('status', 1)->count();
        $this->request_pending = RequestExportation::where('status', 0)->count();
        $this->request_rejected = RequestExportation::where('status', 2)->count();
        $this->request_finished = RequestExportation::where('status', 5)->count();
    }

    public function updatedProformaId($value)
    {
        $this->pending = 1;
        $this->filterOrders();
    }

    public function filterOrders() {
        $response = Http::get('https://sigucapi-hahdhuh9dyetd7h6.canadacentral-01.azurewebsites.net/api/Proforma/' . $this->proformaId);

        if ($response->successful()) {
            $order = $response->json();
            if (isset($order['statu']) && $order['statu'] == 0) {
                $this->orders = $order;
                $this->pending = 3;
            } elseif (isset($order['statu'])) {
                $this->orders = [];
                $this->pending = 2;
            }
        } else {
            $this->orders = [];
            $this->pending = 1;
        }
    }

    public function clear()
    {
        $this->proformaId = '';
        $this->pending = 0;
        $this->orders = [];
    }

    #[On('resetSearch')]
    public function resetSearch()
    {
        $this->clear()  ;
    }

    #[On('successful-toast')]
    public function seeToast($message)
    {
        session()->flash('message', $message);
    }
    public function render()
    {
        return view('livewire.user.request-Exportation-live')->layout('layouts.app');
    }
}
