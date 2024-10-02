<?php

namespace App\Livewire\Provider;

use Carbon\Carbon;
use App\Models\Request;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class AcceptRequestLive extends Component
{
    public $open = false;

    public $request;

    public $type_vehicle;

    public $license_plate;

    public $driver_name;

    public $identification;

    public function mount(Request $request)
    {
        $this->request = $request;
    }

    public function showModal()
    {
        $this->open = true;
    }

    public function store()
    {
        $this->validate([
            'type_vehicle' => 'required',
            'license_plate' => 'required',
            'driver_name' => 'required',
            'identification' => 'required|min_digits:6',
        ],
        [
            'type_vehicle.required' => 'El campo tipo de vehículo es obligatorio',
            'license_plate.required' => 'El campo placa del vehiculo es obligatorio',
            'driver_name.required' => 'El campo nombre del conductor es obligatorio',
            'identification.required' => 'El campo identificación del conductor es obligatorio',
            'identification.min_digits' => 'El campo identificación del conductor debe tener al menos 6 caracteres',
        ]);

        DB::beginTransaction();


        $this->request->update([
            'type_vehicle' => $this->type_vehicle,
            'license_plate' => strtoupper($this->license_plate),
            'driver_name' => $this->driver_name,
            'identification' => $this->identification,
            'date_acceptance' => Carbon::now(),
            'status' => 1,
        ]);

        if ($this->request->id_request_double) {
            $requestDouble = Request::find($this->request->id_request_double);
            $requestDouble->update([
                'type_vehicle' => $this->type_vehicle,
                'license_plate' => strtoupper($this->license_plate),
                'driver_name' => $this->driver_name,
                'identification' => $this->identification,
                'date_acceptance' => Carbon::now(),
                'status' => 1,
            ]);
        }

        DB::commit();

        $this->open = false;
        $this->resetRequest();

        $this->dispatch('request');
    }

    public function resetRequest()
    {
        $this->resetErrorBag();
        $this->reset([
            'type_vehicle',
            'license_plate',
            'driver_name',
            'identification',
        ]);
    }

    public function close()
    {
        $this->resetRequest();
        $this->open = false;
    }

    public function render()
    {
        return view('livewire.provider.accept-request-live');
    }
}
