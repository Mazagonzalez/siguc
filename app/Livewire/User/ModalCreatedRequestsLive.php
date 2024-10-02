<?php

namespace App\Livewire\User;

use Carbon\Carbon;
use App\Models\Request;
use Livewire\Component;
use App\Models\Provider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

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
    public $orderNumber;

    //2da orden
    public $searchOrderId;
    public $orderNumber2 = [];
    public $orderSecond = false;

    public function mount($targetCustomer, $netWeight, $grossWeight, $clientAddress, $unitLoad, $orderNumber)
    {
        $this->nombreCliente = $targetCustomer;
        $this->pesoOrden = $netWeight;
        $this->gross_weight = $grossWeight;
        $this->direccionCliente = $clientAddress;
        $this->tipoContenedor = $unitLoad;
        $this->orderNumber = $orderNumber;

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

    public function updatedFechaCita($value)
    {
        $fechaHoy = Carbon::now()->format('Y-m-d');
        if ($value < $fechaHoy) {
            $this->addError('fechaCita', 'La fecha de la orden no puede ser menor a la fecha de hoy');
        } else {
            $this->resetErrorBag('fechaCita');
        }
    }

    public function updatedSearchOrderId($value)
    {
        $this->resetErrorBag('searchOrderId');

        if ($this->searchOrderId) {
            $response = Http::get('https://sigucapi-hahdhuh9dyetd7h6.canadacentral-01.azurewebsites.net/api/OrderData');
            if ($response->successful()) {
                $orders = $response->json();
                $filteredOrders = array_filter($orders, function ($order) {
                    return $order['order_number'] == $this->searchOrderId;
                });

                if (!empty($filteredOrders)) {
                    $this->orderNumber2 = reset($filteredOrders);
                    $this->orderSecond = true;
                } else {
                    $this->orderNumber2 = null;
                    $this->orderSecond = false;
                    $this->addError('searchOrderId', 'No se encontró ninguna orden con ese número');
                }
            }
        } else {
            $this->resetErrorBag('searchOrderId');
        }
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
            'searchOrderId' => [
                function ($attribute, $value, $fail) {
                    if ($this->searchOrderId && empty($this->orderNumber2)) {
                        $fail('No se encontró ninguna orden con ese número');
                    } elseif (!$this->searchOrderId) {
                        return 'nullable';
                    }
                }
            ],
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

        $request = Request::create([
            'provider' => $this->proveedor,
            'provider_id' => $provider_id,
            'order_number' => $this->orderNumber,
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

        if ($this->searchOrderId && !empty($this->orderNumber2)) {
            $order2 = Request::create([
                'provider' => $this->proveedor,
                'provider_id' => $provider_id,
                'order_number' => $this->orderNumber2['order_number'],
                'client_name' => $this->orderNumber2['target_customer'],
                'client_address' => $this->orderNumber2['client_address'],
                'client_phone' => $this->telefonoCliente,
                'container_type' => $this->orderNumber2['unit_load'],
                'order_weight' => $this->orderNumber2['net_weight'],
                'gross_weight' => $this->orderNumber2['gross_weight'],
                'flete' => $this->flete ? $this->flete : null,
                'date_quotation' => $this->fechaCita,
                'comment' => $this->comentario,
                'double_order' => 1,
            ]);

            $request->update(['id_request_double' => $order2->id]);
        }

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
            'telefonoCliente',
            'flete',
            'fechaCita',
            'comentario',
            'searchOrderId',
        ]);

        $this->resetErrorBag();
    }

    public function render()
{
    return view('livewire.user.modal-created-requests-live');
}
}
