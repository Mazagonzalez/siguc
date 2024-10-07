<?php

namespace App\Livewire\User;

use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Http;

class RequestNationalLive extends Component
{
    public $orders;
    public $orderId;
    public $pending = 0;

    protected $listeners = ['request' => 'mount'];

    public function updatedOrderId($value)
    {
        $this->pending = 1;
        $this->filterOrders();
    }

    public function filterOrders() {
        $response = Http::get('https://sigucapi-hahdhuh9dyetd7h6.canadacentral-01.azurewebsites.net/api/OrderData/' . $this->orderId);

        if ($response->successful()) {
            $order = $response->json();
            if (isset($order['statu']) && $order['statu'] == 0) {
                $this->orders = $order;
                $this->pending = 0;
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
        $this->orderId = '';
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
        return view('livewire.user.request-national-live')->layout('layouts.app');
    }
}
