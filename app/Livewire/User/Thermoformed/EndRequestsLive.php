<?php

namespace App\Livewire\User\Thermoformed;

use Livewire\Component;
use App\Models\RequestThermoformed;
use Illuminate\Support\Facades\Auth;

class EndRequestsLive extends Component
{
    public $requests = [];

    public $start_date;

    public $end_date;

    protected $listeners = ['request' => 'mount'];

    public function confirmDelivery($requestId)
    {
        $request = RequestThermoformed::find($requestId);
        $request->update([
            'status' => 4,
        ]);

        $this->dispatch('request');
    }

    public function closeModalExport()
    {
        $this->reset([
            'start_date',
            'end_date',
        ]);
        $this->resetErrorBag();
    }

    public function resetAllExport()
    {
        $this->reset([
            'start_date',
            'end_date',
        ]);

        $this->resetErrorBag();
    }

    public function render()
    {
        $items = RequestThermoformed::where('user_id', Auth::id())->where('status', 3)->orderBy('updated_at', 'desc');

        if (!is_null($this->start_date) and !is_null($this->end_date) and $this->end_date < $this->start_date) {
            $this->addError('start_date', __('La fecha inicial debe ser una fecha anterior o igual a la fecha final.'));
        }

        if (!is_null($this->start_date) and !is_null($this->end_date) and $this->end_date >= $this->start_date) {
            $items->whereBetween(
                'updated_at',
                [$this->start_date . ' 00:00:00', $this->end_date . ' 23:59:59']
            );
        }

        $requests = $items->get();

        return view('livewire.user.thermoformed.end-requests-live', ['requestsCollection' => $requests]);
    }
}
