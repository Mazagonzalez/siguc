<?php

namespace App\Livewire\User\National;

use Livewire\Component;

class DetailsSecondOrderLive extends Component
{
    public $order_number;

    public $target_customer;

    public $client_address;

    public $unit_load;

    public $net_weight;

    public $gross_weight;

    public function mount($order_number = null, $target_customer = null, $client_address = null, $unit_load = null, $net_weight = null, $gross_weight = null)
    {
        $this->order_number = $order_number;
        $this->target_customer = $target_customer;
        $this->client_address = $client_address;
        $this->unit_load = $unit_load;
        $this->net_weight = $net_weight;
        $this->gross_weight = $gross_weight;
    }

    public function render()
    {
        return view('livewire.user.national.details-second-order-live');
    }
}
