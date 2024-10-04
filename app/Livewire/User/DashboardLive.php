<?php

namespace App\Livewire\User;

use App\Models\Request;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Http;

class DashboardLive extends Component
{
    public $orders = [];
    public $orderId;
    public $serch = false;
    public $request_acepted;
    public $request_pending;
    public $request_rejected;
    public $request_finished;

    protected $listeners = ['request' => 'mount'];

    public function mount()
    {
        $this->fetchOrders();
        $this->totalRequest();
    }

    public function totalRequest()
    {
        $this->request_acepted = Request::where('status', 1)->where('double_order', 0)->count();
        $this->request_pending = Request::where('status', 0)->where('double_order', 0)->count();
        $this->request_rejected = Request::where('status', 2)->where('double_order', 0)->count();
        $this->request_finished = Request::where('status', 3)->where('double_order', 0)->count();
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
