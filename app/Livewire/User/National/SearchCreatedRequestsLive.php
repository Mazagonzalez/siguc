<?php

namespace App\Livewire\User\National;

use Carbon\Carbon;
use App\Models\History;
use App\Models\Request;
use Livewire\Component;
use App\Models\Provider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class SearchCreatedRequestsLive extends Component
{
    public $open = false;
    public $proveedores = [];
    public $proveedor;
    public $nombreCliente;
    public $direccionCliente;
    public $telefonoCliente;
    public $type_vehicle;
    public $tipoContenedor;
    public $pesoOrden;
    public $gross_weight;
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
    }

    public function showModal()
    {
        $this->open = true;
        $this->proveedores = Provider::pluck('company_name')->toArray();
    }

    public function updated($field)
    {
        $this->resetErrorBag($field);
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
            $response = Http::get('https://sigucapi-hahdhuh9dyetd7h6.canadacentral-01.azurewebsites.net/api/OrderData/' . $this->searchOrderId);
            if ($response->successful()) {
                $order = $response->json();

                if ($order) {
                    if (isset($order['statu']) && $order['statu'] == 0) {
                        $this->orderNumber2 = $order;
                        $this->orderSecond = true;
                        $this->resetErrorBag('searchOrderId');
                    }else {
                        $this->resetErrorBag('searchOrderId');
                        $this->orderNumber2 = null;
                        $this->orderSecond = false;
                        $this->addError('searchOrderId', 'Ya se creo esta orden');
                    }
                } else {
                    $this->resetErrorBag('searchOrderId');
                    $this->orderNumber2 = null;
                    $this->orderSecond = false;
                    $this->addError('searchOrderId', 'No se encontró ninguna orden con ese número');
                }
            } else {
                $this->resetErrorBag('searchOrderId');
                $this->orderNumber2 = null;
                $this->orderSecond = false;
                $this->addError('searchOrderId', 'No se encontró ninguna orden con ese número');
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
            'type_vehicle' => 'required',
            'tipoContenedor' => 'required',
            'pesoOrden' => 'required',
            'gross_weight' => 'required',
            'fechaCita' => 'required',
            'searchOrderId' => [
                function ($attribute, $value, $fail) {
                    if ($this->orderNumber == $this->searchOrderId) {
                        $fail('El número de orden ya fue ingresado en la orden principal');
                    } elseif ($this->searchOrderId && empty($this->orderNumber2)) {
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
            'type_vehicle.required' => 'El campo tipo de vehículo es obligatorio',
            'tipoContenedor.required' => 'El campo tipo de contenedor es obligatorio',
            'pesoOrden.required' => 'El campo peso de la orden es obligatorio',
            'gross_weight.required' => 'El campo peso bruto es obligatorio',
            'fechaCita.required' => 'El campo fecha de la cita es obligatorio',
        ]);

        DB::beginTransaction();

        $provider_id = Provider::where('company_name', $this->proveedor)->first()->id;

        $request = Request::create([
            'user_id' => Auth::id(),
            'provider' => $this->proveedor,
            'provider_id' => $provider_id,
            'order_number' => $this->orderNumber,
            'client_name' => $this->nombreCliente,
            'client_address' => $this->direccionCliente,
            'client_phone' => $this->telefonoCliente,
            'type_vehicle' => $this->type_vehicle,
            'container_type' => $this->tipoContenedor,
            'order_weight' => $this->pesoOrden,
            'gross_weight' => $this->gross_weight,
            'date_quotation' => $this->fechaCita,
            'comment' => $this->comentario,
        ]);

        if ($this->searchOrderId && !empty($this->orderNumber2)) {
            $order2 = Request::create([
                'user_id' => Auth::id(),
                'provider' => $this->proveedor,
                'provider_id' => $provider_id,
                'order_number' => $this->orderNumber2['order_number'],
                'client_name' => $this->orderNumber2['target_customer'],
                'client_address' => $this->orderNumber2['client_address'],
                'client_phone' => $this->telefonoCliente,
                'type_vehicle' => $this->type_vehicle,
                'container_type' => $this->orderNumber2['unit_load'],
                'order_weight' => $this->orderNumber2['net_weight'],
                'gross_weight' => $this->orderNumber2['gross_weight'],
                'date_quotation' => $this->fechaCita,
                'comment' => $this->comentario,
                'double_order' => 1,
            ]);

            $request->update(['id_request_double' => $order2->id]);
        }

        History::create([
            'type_request' => 'Solicitud nacional',
            'request_id' => $request->id,
        ]);

        DB::commit();

        // Cambia el estado en el EndPoint
        $objeto = json_encode(1);

        if ($request->order_number) {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->patch('https://sigucapi-hahdhuh9dyetd7h6.canadacentral-01.azurewebsites.net/api/OrderData/' . $request->order_number, $objeto);

            if ($request->id_request_double) {
                $response1 = Http::withHeaders([
                    'Content-Type' => 'application/json',
                ])->patch('https://sigucapi-hahdhuh9dyetd7h6.canadacentral-01.azurewebsites.net/api/OrderData/' . $order2->order_number, $objeto);
            }
        }

        $this->resetRequest();
        $this->open = false;
        $this->dispatch('request');
        $this->dispatch('resetSearch');
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
            'type_vehicle',
            'fechaCita',
            'comentario',
            'searchOrderId',
        ]);

        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.user.national.search-created-requests-live');
    }
}
