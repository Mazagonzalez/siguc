<?php

namespace App\Livewire\User;

use App\Models\Request;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Http;

class DashboardLive extends Component
{
    public $orders;
    public $orderId;
    public $pending = 0;
    public $request_acepted;
    public $request_pending;
    public $request_rejected;
    public $request_finished;

    protected $listeners = ['request' => 'mount'];

    public function mount()
    {
        $this->totalRequest();
    }

    public function totalRequest()
    {
        $this->request_acepted = Request::where('status', 1)->where('double_order', 0)->count();
        $this->request_pending = Request::where('status', 0)->where('double_order', 0)->count();
        $this->request_rejected = Request::where('status', 2)->where('double_order', 0)->count();
        $this->request_finished = Request::where('status', 3)->where('double_order', 0)->count();
    }

    public function updatedOrderId($value)
    {
        $this->pending = 1;
        $this->filterOrders();
    }

    public function filterOrders() {
        $response = Http::get('https://sigucapi-hahdhuh9dyetd7h6.canadacentral-01.azurewebsites.net/api/OrderData/' . $this->orderId);

        if ($response->successful()) {
            $order = $response->json();
            if ($order['statu'] == 0) {
                $this->orders = $order;
                $this->pending = 0;
            } else {
                $this->orders = [];
                $this->pending = 2;
            }
        } else {
            $this->orders = [];
            $this->pending = 1;
        }
        $this->dispatch('request');
    }

    #[On('successful-toast')]
    public function seeToast($message)
    {
        session()->flash('message', $message);
    }

    public function render()
    {
        return view('livewire.user.dashboard-live');
    }
}
