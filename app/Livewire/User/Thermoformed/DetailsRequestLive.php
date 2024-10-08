<?php

namespace App\Livewire\User\Thermoformed;

use App\Models\RequestThermoformed;
use Livewire\Component;

class DetailsRequestLive extends Component
{
    public $open = false;

    public $request;

    public function mount(RequestThermoformed $request)
    {
        $this->request = $request;
    }

    public function showModal()
    {
        $this->open = true;
    }

    public function close()
    {
        $this->open = false;
    }

    public function render()
    {
        return view('livewire.user.thermoformed.details-request-live');
    }
}
