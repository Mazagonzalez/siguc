<?php

namespace App\Livewire\User;

use App\Models\Request;
use Livewire\Component;
use App\Models\Provider;

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
    public $fechaCita;
    public $comentario;

    public function showModal()
    {
        $this->open = true;
        $this->reset([
            'proveedor',
            'nombreCliente',
            'direccionCliente',
            'telefonoCliente',
            'tipoContenedor',
            'pesoOrden',
            'fechaCita',
            'comentario',
        ]);
        $this->resetErrorBag();
        $this->proveedores = Provider::pluck('company_name')->toArray();
    }

    public function store()
    {
        $this->validate([
            'proveedor' => 'required',
            'nombreCliente' => 'required',
            'direccionCliente' => 'required',
            'telefonoCliente' => 'required|numeric|min_digits:7',
            'tipoContenedor' => 'required',
            'pesoOrden' => [
                'required',
                'numeric',
                function ($attribute, $value, $fail) {
                    if (strpos($value, '.') !== false || strpos($value, ',') !== false) {
                        $fail('El campo peso de la orden no debe contener puntos ni comas.');
                    }
                },
            ],
            'fechaCita' => 'required',
        ], [
            'proveedor.required' => 'El campo proveedor es obligatorio',
            'nombreCliente.required' => 'El campo nombre del cliente es obligatorio',
            'direccionCliente.required' => 'El campo dirección del cliente es obligatorio',
            'telefonoCliente.required' => 'El campo teléfono del cliente es obligatorio',
            'telefonoCliente.numeric' => 'El campo teléfono del cliente debe ser numérico',
            'telefonoCliente.min_digits' => 'El campo teléfono del cliente debe tener al menos 7 caracteres',
            'tipoContenedor.required' => 'El campo tipo de contenedor es obligatorio',
            'pesoOrden.required' => 'El campo peso de la orden es obligatorio',
            'pesoOrden.numeric' => 'El campo peso de la orden debe ser numérico',
            'fechaCita.required' => 'El campo fecha de la cita es obligatorio',
        ]);

        $request = Request::create([
            'provider' => $this->proveedor,
            'client_name' => $this->nombreCliente,
            'client_address' => $this->direccionCliente,
            'client_phone' => $this->telefonoCliente,
            'container_type' => $this->tipoContenedor,
            'order_weight' => $this->pesoOrden,
            'date_quotation' => $this->fechaCita,
            'comment' => $this->comentario,
        ]);

        //$this->emit('requestCreated');

        $this->reset([
            'proveedor',
            'nombreCliente',
            'direccionCliente',
            'telefonoCliente',
            'tipoContenedor',
            'pesoOrden',
            'fechaCita',
            'comentario',
        ]);
        $this->resetErrorBag();
        $this->open = false;
    }

    public function close()
    {
        $this->open = false;
    }

    public function render()
    {
        return view('livewire.user.modal-created-requests-live');
    }
}
