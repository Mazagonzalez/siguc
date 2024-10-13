<?php

namespace App\Livewire\Provider;

use Carbon\Carbon;
use App\Models\History;
use App\Models\Request;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class AcceptRequestLive extends Component
{
    public $open = false;

    public $request;

    public $license_plate;

    public $driver_name;

    public $driver_phone;

    public $identification;

    public $initial_flete;

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
            'license_plate' => 'required',
            'driver_name' => 'required',
            'driver_phone' => 'required',
            'identification' => 'required|min_digits:6',
            'initial_flete' => 'required',
        ],
        [
            'license_plate.required' => 'El campo placa del vehiculo es obligatorio',
            'driver_name.required' => 'El campo nombre del conductor es obligatorio',
            'driver_phone.required' => 'El campo teléfono del conductor es obligatorio',
            'identification.required' => 'El campo identificación del conductor es obligatorio',
            'identification.min_digits' => 'El campo identificación del conductor debe tener al menos 6 caracteres',
            'initial_flete.required' => 'El campo flete inicial es obligatorio',
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
        if ($diferencia->s > 0) {
            $resultado[] = $diferencia->s . ' segundo' . ($diferencia->s > 1 ? 's' : '');
        }

        $this->initial_flete = str_replace('.', '', $this->initial_flete);
        $time_response = implode(' y ', $resultado);

        $history = History::where('request_id', $this->request->id)
                            ->where('type_request', 'Solicitud nacional')
                            ->first();

        DB::beginTransaction();

        $this->request->update([
            'license_plate' => strtoupper($this->license_plate),
            'driver_name' => $this->driver_name,
            'driver_phone' => $this->driver_phone,
            'identification' => $this->identification,
            'initial_flete' => $this->initial_flete,
            'date_acceptance' => $date_acceptance->toDateTimeString(),
            'time_response' => $time_response,
            'status' => 1,
        ]);

        if ($this->request->id_request_double) {
            $requestDouble = Request::find($this->request->id_request_double);
            $requestDouble->update([
                'license_plate' => strtoupper($this->license_plate),
                'driver_name' => $this->driver_name,
                'driver_phone' => $this->driver_phone,
                'identification' => $this->identification,
                'initial_flete' => $this->initial_flete,
                'date_acceptance' => $date_acceptance->toDateTimeString(),
                'time_response' => $time_response,
                'status' => 1,
            ]);
        }

        $history->update([
            'status' => 1,
        ]);

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
            'license_plate',
            'driver_name',
            'driver_phone',
            'identification',
            'initial_flete',
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
