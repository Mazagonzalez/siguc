<?php

namespace App\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DashboardLive extends Component
{
    public $orders = [];
    public $orderId;

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
    }

    public function filterOrders()
    {
        if ($this->orderId) {
            $response = Http::get('https://sigucapi-hahdhuh9dyetd7h6.canadacentral-01.azurewebsites.net/api/OrderData');
            if ($response->successful()) {
                $orders = $response->json();
                $this->orders = array_filter($orders, function ($order) {
                    return $order['id'] == $this->orderId;
                });
            }
        } else {
            $this->fetchOrders();
        }
    }

    public function render()
    {
        return view('livewire.user.dashboard-live', ['orders' => $this->orders]);
    }
}
