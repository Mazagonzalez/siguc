<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;

class DateSessionLive extends Component
{
    public $date;

    public function mount()
    {
        Carbon::setLocale('es');
        $this->date = Carbon::now()->isoFormat('D [de] MMMM, dddd');
    }

    public function render()
    {
        return view('livewire.date-session-live');
    }
}
