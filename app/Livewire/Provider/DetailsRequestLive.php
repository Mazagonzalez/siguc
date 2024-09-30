<?php

namespace App\Livewire\Provider;

use App\Models\Request;
use Livewire\Component;

class DetailsRequestLive extends Component
{
    public $open = false;

    public $request;

    public function mount(Request $request)
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
        return view('livewire.provider.details-request-live');
    }
}
