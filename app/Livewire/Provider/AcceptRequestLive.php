<?php

namespace App\Livewire\Provider;

use Carbon\Carbon;
use App\Models\Request;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

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
        $this->resetRequest();
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

        // Tiempo de diferencia entre la creación de la solicitud y la aceptación
        $date_acceptance = Carbon::now();
        $created_at = Carbon::parse($this->request->created_at);
        $diferencia = $created_at->diff($date_acceptance);

        // Formatear la diferencia en un string legible
        $resultado = [];
        if ($diferencia->d > 0) {
            $resultado[] = $diferencia->d . ' día' . ($diferencia->d > 1 ? 's' : '');
        }
        if ($diferencia->h > 0) {
            $resultado[] = $diferencia->h . ' hora' . ($diferencia->h > 1 ? 's' : '');
        }
        if ($diferencia->i > 0) {
            $resultado[] = $diferencia->i . ' minuto' . ($diferencia->i > 1 ? 's' : '');
        }

        // Une los resultados en un string
        $time_response = implode(' y ', $resultado);

        DB::beginTransaction();

        $this->request->update([
            'type_vehicle' => $this->type_vehicle,
            'license_plate' => strtoupper($this->license_plate),
            'driver_name' => $this->driver_name,
            'identification' => $this->identification,
            'date_acceptance' => $date_acceptance->toDateTimeString(),
            'time_response' => $time_response,
            'status' => 1,
        ]);

        if ($this->request->id_request_double) {
            $requestDouble = Request::find($this->request->id_request_double);
            $requestDouble->update([
                'type_vehicle' => $this->type_vehicle,
                'license_plate' => strtoupper($this->license_plate),
                'driver_name' => $this->driver_name,
                'identification' => $this->identification,
                'date_acceptance' => $date_acceptance->toDateTimeString(),
                'time_response' => $time_response,
                'status' => 1,
            ]);
        }

        DB::commit();

        // Cambia el estado en el EndPoint
        $objeto = json_encode(1);

        if ($this->request->order_number) {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->patch('https://sigucapi-hahdhuh9dyetd7h6.canadacentral-01.azurewebsites.net/api/OrderData/' . $this->request->order_number, $objeto);

            if ($this->request->id_request_double) {
                $response1 = Http::withHeaders([
                    'Content-Type' => 'application/json',
                ])->patch('https://sigucapi-hahdhuh9dyetd7h6.canadacentral-01.azurewebsites.net/api/OrderData/' . $requestDouble->order_number, $objeto);
            }
        }

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
