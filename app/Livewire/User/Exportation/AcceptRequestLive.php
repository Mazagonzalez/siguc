<?php

namespace App\Livewire\User\Exportation;

use Carbon\Carbon;
use App\Models\History;
use Livewire\Component;
use App\Models\Proforma;
use App\Models\RequestExportation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class AcceptRequestLive extends Component
{
    public $open = false;
    public $request;
    public $proforma_id;
    public $proformas;
    public $license_plates = [];
    public $driver_names = [];
    public $driver_phones = [];
    public $identifications = [];
    public $initial_flete;

    public function mount(RequestExportation $request)
    {
        $this->request = $request;

        $this->proforma_id = $this->request->proforma_id;
        $this->proformas = Proforma::where('proforma_id', $this->proforma_id)->get();
    }

    public function showModal()
    {
        $this->resetRequest();
        $this->open = true;
    }

    public function store()
    {
        $this->validate([
            'license_plates.*' => 'required',
            'driver_names.*' => 'required',
            'driver_phones.*' => 'required',
            'identifications.*' => 'required|min_digits:6',
            'initial_flete' => 'required',
        ],
        [
            'license_plates.*.required' => 'El campo placa del vehiculo es obligatorio',
            'driver_names.*.required' => 'El campo nombre del conductor es obligatorio',
            'driver_phones.*.required' => 'El campo teléfono del conductor es obligatorio',
            'identifications.*.required' => 'El campo identificación del conductor es obligatorio',
            'identifications.*.min_digits' => 'El campo identificación del conductor debe tener al menos 6 caracteres',
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

        $history = History::where('request_exportation_id', $this->request->id)
                            ->where('type_request', 'Solicitud exportacion')
                            ->first();

        DB::beginTransaction();

        $this->request->update([
            'initial_flete' => $this->initial_flete,
            'date_acceptance' => $date_acceptance->toDateTimeString(),
            'time_response' => $time_response,
            'status' => 1,
        ]);

        foreach ($this->proformas as $index => $proforma) {
            $proforma->update([
                'license_plate' => strtoupper($this->license_plates[$index]),
                'driver_name' => $this->driver_names[$index],
                'driver_phone' => $this->driver_phones[$index],
                'identification' => $this->identifications[$index],
                'status' => 1,
            ]);
        }

        $history->update([
            'status' => 1,
        ]);

        DB::commit();

        $this->open = false;
        $this->resetRequest();

        $this->dispatch('request-pending');
    }

    public function resetRequest()
    {
        $this->resetErrorBag();
        $this->reset([
            'license_plates',
            'driver_names',
            'driver_phones',
            'identifications',
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
        return view('livewire.user.exportation.accept-request-live');
    }
}
