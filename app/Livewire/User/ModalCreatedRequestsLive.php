<?php

namespace App\Livewire\User;

use App\Models\Request;
use Livewire\Component;
use App\Models\Provider;
use Illuminate\Support\Facades\DB;

class ModalCreatedRequestsLive extends Component
{
    public $open = false;
    public $proveedores = [];
    public $proveedor;
    public $nombreCliente;
    public $direccionCliente;
    public $telefonoCliente;
    public $tipoContenedor;
    public $pesoOrden;
    public $gross_weight;
    public $flete;
    public $fechaCita;
    public $comentario;

    public function mount($targetCustomer, $netWeight, $grossWeight, $clientAddress, $unitLoad)
    {
        $this->nombreCliente = $targetCustomer;
        $this->pesoOrden = $netWeight;
        $this->gross_weight = $grossWeight;
        $this->direccionCliente = $clientAddress;
        $this->tipoContenedor = $unitLoad;

        //eliminacion de letra en apartados de pesos
        $this->pesoOrden = preg_replace('/\D/', '', $this->pesoOrden);
        $this->gross_weight = preg_replace('/\D/', '', $this->gross_weight);
    }

    public function showModal()
    {
        $this->open = true;
        $this->proveedores = Provider::pluck('company_name')->toArray();
    }

    public function updated($value)
    {
       $this->resetErrorBag();
    }

    public function store()
    {
        $this->validate([
            'proveedor' => 'required',
            'nombreCliente' => 'required',
            'direccionCliente' => 'required',
            'telefonoCliente' => 'required|min_digits:7',
            'tipoContenedor' => 'required',
            'pesoOrden' => 'required',
            'gross_weight' => 'required',
            'flete' => 'nullable',
            'fechaCita' => 'required',
        ],
        [
            'proveedor.required' => 'El campo proveedor es obligatorio',
            'nombreCliente.required' => 'El campo nombre del cliente es obligatorio',
            'direccionCliente.required' => 'El campo dirección del cliente es obligatorio',
            'telefonoCliente.required' => 'El campo teléfono del cliente es obligatorio',
            'telefonoCliente.min_digits' => 'El campo teléfono del cliente debe tener al menos 7 caracteres',
            'tipoContenedor.required' => 'El campo tipo de contenedor es obligatorio',
            'pesoOrden.required' => 'El campo peso de la orden es obligatorio',
            'gross_weight.required' => 'El campo peso bruto es obligatorio',
            'fechaCita.required' => 'El campo fecha de la cita es obligatorio',
        ]);

        DB::beginTransaction();

        $provider_id = Provider::where('company_name', $this->proveedor)->first()->id;

        Request::create([
            'provider' => $this->proveedor,
            'provider_id' => $provider_id,
            'client_name' => $this->nombreCliente,
            'client_address' => $this->direccionCliente,
            'client_phone' => $this->telefonoCliente,
            'container_type' => $this->tipoContenedor,
            'order_weight' => $this->pesoOrden,
            'gross_weight' => $this->gross_weight,
            'flete' => $this->flete ? $this->flete : null,
            'date_quotation' => $this->fechaCita,
            'comment' => $this->comentario,
        ]);

        DB::commit();

        $this->resetRequest();
        $this->open = false;
        $this->dispatch('successful-toast', message: '¡Solicitud creada exitosamente!');
    }

    public function close()
    {
        $this->resetRequest();

        $this->open = false;
    }

    public function resetRequest()
    {
        $this->reset([
            'proveedor',
            'nombreCliente',
            'direccionCliente',
            'telefonoCliente',
            'tipoContenedor',
            'pesoOrden',
            'gross_weight',
            'flete',
            'fechaCita',
            'comentario',
        ]);

        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.user.modal-created-requests-live');
    }
}
