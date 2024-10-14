<?php

namespace App\Livewire\User\Exportation;

use Carbon\Carbon;
use App\Models\History;
use Livewire\Component;
use App\Models\Proforma;
use App\Models\Provider;
use App\Models\RequestExportation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class SearchCreatedRequestsExportationLive extends Component
{
    public $open = false;
    public $order; //proforma completa
    public $proforma_id; //numero de orden o proforma es igual
    public $providers = [];
    public $provider;
    public $client_name;
    public $client_address;
    public $client_phone;
    public $type_vehicle;
    public $total_net_weight;
    public $total_gross_weight;
    public $vehicle_quantity;
    public $order_quantity;
    public $date_quotation;
    public $comment;

    public function mount($order)
    {
        $this->order = $order;

        if ($order) {
            $this->proforma_id = $order['order_number'];
            $this->client_name = $order['target_customer'];
            $this->client_address = $order['client_address'];
            $this->total_net_weight = $order['net_weight'];
            $this->total_gross_weight = $order['gross_weight'];
            $this->order_quantity = count($order['orders']);
        }

        $this->type_vehicle = 'Tractomula';
    }

    public function showModal()
    {
        $this->open = true;
        $this->providers = Provider::pluck('company_name')->toArray();
    }

    public function updated($field)
    {
        $this->resetErrorBag($field);
    }

    public function updatedDateQuotation($value)
    {
        $fechaHoy = Carbon::now()->format('Y-m-d');
        if ($value < $fechaHoy) {
            $this->addError('date_quotation', 'La fecha de la orden no puede ser menor a la fecha de hoy');
        } else {
            $this->resetErrorBag('date_quotation');
        }
    }

    public function store()
    {
        $this->validate([
            'provider' => 'required',
            'client_name' => 'required',
            'client_address' => 'required',
            'client_phone' => 'required',
            'type_vehicle' => 'required',
            'total_net_weight' => 'required',
            'total_gross_weight' => 'required',
            'order_quantity' => 'required',
            'date_quotation' => 'required',
        ],
        [
            'provider.required' => 'El campo proveedor es obligatorio',
            'client_name.required' => 'El campo nombre del cliente es obligatorio',
            'client_address.required' => 'El campo dirección del cliente es obligatorio',
            'client_phone.required' => 'El campo teléfono del cliente es obligatorio',
            'type_vehicle.required' => 'El campo tipo de vehículo es obligatorio',
            'total_net_weight.required' => 'El campo peso neto total es obligatorio',
            'total_gross_weight.required' => 'El campo peso bruto total es obligatorio',
            'order_quantity.required' => 'El campo cantidad de vehículos es obligatorio',
            'date_quotation.required' => 'El campo fecha de cita es obligatorio',
        ]);

        DB::beginTransaction();

        $provider_id = Provider::where('company_name', $this->provider)->first()->id;

        $exportation = RequestExportation::create([
            'user_id' => Auth::id(),
            'provider' => $this->provider,
            'provider_id' => $provider_id,
            'proforma_id' => $this->proforma_id,
            'client_name' => $this->client_name,
            'client_address' => $this->client_address,
            'client_phone' => $this->client_phone,
            'type_vehicle' => $this->type_vehicle,
            'total_net_weight' => $this->total_net_weight,
            'total_gross_weight' => $this->total_gross_weight,
            'vehicle_quantity' => $this->order_quantity,
            'date_quotation' => $this->date_quotation,
            'order_quantity' => $this->order_quantity,
            'comment' => $this->comment,
        ]);

        foreach ($this->order['orders'] as $orderItem) {

            $proforma = Proforma::create([
                'proforma_id' => $orderItem['proforma_id'],
                'user_id' => Auth::id(),
                'provider' => $this->provider,
                'provider_id' => $provider_id,
                'order_number' => $orderItem['order_number'],
                'client_name' => $orderItem['target_customer'],
                'client_address' => $orderItem['client_address'],
                'client_phone' => $this->client_phone,
                'type_vehicle' => $this->type_vehicle,
                'net_weight' => $orderItem['net_weight'],
                'gross_weight' => $orderItem['gross_weight'],
                'container_type' => $orderItem['unit_load'],
                'comment' => $this->comment,
                'date_quotation' => $this->date_quotation,
            ]);
        }

        History::create([
            'type_request' => 'Solicitud exportacion',
            'user_id' => Auth::id(),
            'provider_id' => $provider_id,
            'request_exportation_id' => $exportation->id,
        ]);

        Db::commit();

       // Cambia el estado en el EndPoint
       $objeto = json_encode(1);

       if ($exportation->proforma_id) {
           $response = Http::withHeaders([
               'Content-Type' => 'application/json',
           ])->patch('https://sigucapi-hahdhuh9dyetd7h6.canadacentral-01.azurewebsites.net/api/Proforma/' . $exportation->proforma_id, $objeto);
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
            'order_quantity',
            'provider',
            'client_name',
            'client_address',
            'client_phone',
            'type_vehicle',
            'total_net_weight',
            'total_gross_weight',
            'vehicle_quantity',
            'date_quotation',
            'order_quantity',
            'comment',
        ]);

        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.user.exportation.search-created-requests-exportation-live');
    }
}
