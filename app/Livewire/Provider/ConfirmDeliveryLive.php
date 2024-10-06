<?php

namespace App\Livewire\Provider;

use Carbon\Carbon;
use App\Models\Invoice;
use App\Models\Request;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ConfirmDeliveryLive extends Component
{
    use WithFileUploads;

    public $open = false;

    public $request;

    public $final_flete;

    public $invoice;

    public $delivery_commentary;

    public function mount($request)
    {
        $this->request = $request;
        $this->resetErrorBag();
    }

    public function showModal()
    {
        $this->resetRequest();
        $this->open = true;
    }

    public function store()
    {
        $this->validate([
            'final_flete' => 'required',
            'invoice' => 'required|file|mimes:png,jpg,pdf|max:10240',
        ],
        [
            'final_flete.required' => 'El campo flete final es obligatorio',
            'invoice.required' => 'El campo factura es obligatorio',
            'invoice.file' => 'El campo factura debe ser un archivo',
            'invoice.mimes' => 'El campo factura debe ser un archivo de tipo: png, jpg o pdf',
            'invoice.max' => 'El campo factura no debe pesar más de 10MB',
        ]);

        //pendiente codigo azure
        //$this->saveInvoice();
        $this->final_flete = str_replace('.', '', $this->final_flete);

        DB::beginTransaction();

        $this->request->update([
            'status' => 3,
            'final_flete' => $this->final_flete,
            'delivery_commentary' => $this->delivery_commentary,
            'date_loading' => Carbon::now()->toDateTimeString(),
        ]);

        if ($this->request->id_request_double) {
            $requestDouble = Request::find($this->request->id_request_double);
            $requestDouble->update([
                'status' => 3,
                'final_flete' => $this->final_flete,
                'delivery_commentary' => $this->delivery_commentary,
                'date_loading' => Carbon::now()->toDateTimeString(),
            ]);
        }

        DB::commit();

        $this->open = false;
        $this->resetRequest();
        $this->dispatch('request');
    }

    public function saveInvoice()
    {
        // forma generada por copilot de 0
        /*// Generar un nombre único para el archivo
        $fileName = time() . '_' . $this->invoice->getClientOriginalName();

        // Subir el archivo a Azure Blob Storage
        $path = Storage::disk('azure')->put($fileName, file_get_contents($this->invoice->getRealPath()));

        // Retornar la ruta del archivo subido o hacer algo con ella
        session()->flash('message', 'Archivo subido exitosamente: ' . $path);*/


        // Obtener la extensión del archivo

        try {
            $extension = $this->invoice->getClientOriginalExtension();

            // Generar un nombre único para el archivo
            $fileName = md5(Str::random(5) . $this->invoice->getClientOriginalName() . time()) . '.' . $extension;

            // Definir el path de almacenamiento
            $path = 'invoices';

            // Almacenar el archivo en Azure Blob Storage
            $this->invoice->storeAs($path, $fileName, 'azure');

            // Crear un nuevo registro en la tabla invoices
            Invoice::create([
                'type_invoice' => $extension,
                'request_id' => $this->request->id,
                'attachment' => $path . '/' . $fileName,
                'flete' => $this->final_flete,
            ]);
        } catch (\Exception $th) {
            Log::info($th);
        }
    }

    public function resetRequest()
    {
        $this->resetErrorBag();
        $this->reset([
            'final_flete',
            'invoice',
            'delivery_commentary',
        ]);
    }

    public function close()
    {
        $this->resetRequest();
        $this->open = false;
    }

    public function render()
    {
        return view('livewire.provider.confirm-delivery-live');
    }
}
