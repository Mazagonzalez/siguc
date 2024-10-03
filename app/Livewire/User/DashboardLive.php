<?php

namespace App\Livewire\User;

use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Http;

class DashboardLive extends Component
{
    public $orders = [];
    public $orderId;
    public $serch = false;

    public function mount()
    {
        $this->fetchOrders();
    }

    public function fetchOrders()
    {
        $response = Http::get('https://sigucapi-hahdhuh9dyetd7h6.canadacentral-01.azurewebsites.net/api/OrderData');
        if ($response->successful()) {
            $this->orders = $response->json();
        }
    }

    public function updatedOrderId($value)
    {
        $this->filterOrders();
        $this->serch = true;
    }

    public function filterOrders()
    {
        if ($this->orderId) {
            $response = Http::get('https://sigucapi-hahdhuh9dyetd7h6.canadacentral-01.azurewebsites.net/api/OrderData');
            if ($response->successful()) {
                $orders = $response->json();
                $this->orders = array_filter($orders, function ($order) {
                    return $order['order_number'] == $this->orderId;
                });
            }
        } else {
            $this->fetchOrders();
        }
    }

    #[On('successful-toast')]
    public function seeToast($message)
    {
        session()->flash('message', $message);
    }

    public function render()
    {
        return view('livewire.user.dashboard-live', ['orders' => $this->orders]);
    }
}
