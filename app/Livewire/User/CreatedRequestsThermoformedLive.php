<?php

namespace App\Livewire\User;

use Carbon\Carbon;
use App\Models\History;
use Livewire\Component;
use App\Models\Provider;
use Illuminate\Support\Facades\DB;
use App\Models\RequestThermoformed;
use Illuminate\Support\Facades\Auth;

class CreatedRequestsThermoformedLive extends Component
{
    public $open = false;
    public $providers = [];
    public $provider;
    public $client_name;
    public $client_address;
    public $client_phone;
    public $city;
    public $type_vehicle;
    public $container_type;
    public $box_quantity;
    public $date_quotation;
    public $comment;

    public function showModal()
    {
        $this->open = true;
        $this->providers = Provider::pluck('company_name')->toArray();
    }

    public function updated($value)
    {
        $this->resetErrorBag($value);
    }

    public function updatedFechaCita($value)
    {
        $todayDate = Carbon::now()->format('Y-m-d');
        if ($value < $todayDate) {
            $this->addError('fechaCita', 'La fecha de la orden no puede ser menor a la fecha de hoy');
        } else {
            $this->resetErrorBag('fechaCita');
        }
    }

    public function store()
    {
        $this->validate([
            'provider' => 'required',
            'client_name' => 'required',
            'client_address' => 'required',
            'client_phone' => 'required',
            'city' => 'required',
            'type_vehicle' => 'required',
            'container_type' => [
                function ($attribute, $value, $fail) {
                    if ($this->type_vehicle == 'Tractomula' ) {
                        return 'required';
                    } else {
                        return 'nullable';
                    }
                }
            ],
            'box_quantity' => 'required',
            'date_quotation' => 'required',
        ], [
            'provider.required' => 'El campo proveedor es requerido',
            'client_name.required' => 'El campo nombre del cliente es requerido',
            'client_address.required' => 'El campo dirección del cliente es requerido',
            'client_phone.required' => 'El campo teléfono del cliente es requerido',
            'city.required' => 'El campo ciudad es requerido',
            'type_vehicle.required' => 'El campo tipo de vehículo es requerido',
            'container_type.required' => 'El campo tipo de contenedor es requerido',
            'box_quantity.required' => 'El campo cantidad de blox es requerido',
            'date_quotation.required' => 'El campo fecha de cotización es requerido',
        ]);

        DB::beginTransaction();

        $provider_id = Provider::where('company_name', $this->provider)->first()->id;

        $request = RequestThermoformed::create([
            'user_id' => Auth::id(),
            'provider' => $this->provider,
            'provider_id' => $provider_id,
            'client_name' => $this->client_name,
            'client_address' => $this->client_address,
            'client_phone' => $this->client_phone,
            'city' => $this->city,
            'type_vehicle' => $this->type_vehicle,
            'container_type' => $this->container_type? $this->container_type : null,
            'box_quantity' => $this->box_quantity,
            'date_quotation' => $this->date_quotation,
            'comment' => $this->comment,
        ]);

        DB::commit();


        $this->resetRequest();
        $this->open = false;
        $this->dispatch('request');
    }

    function close()
    {
        $this->resetRequest();
        $this->open = false;
    }

    public function resetRequest()
    {
        $this->reset([
            'provider',
            'client_name',
            'client_address',
            'client_phone',
            'city',
            'type_vehicle',
            'container_type',
            'box_quantity',
            'date_quotation',
            'comment'
        ]);

        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.user.created-requests-thermoformed-live');
    }
}
