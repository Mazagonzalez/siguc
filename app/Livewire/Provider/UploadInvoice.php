<?php

namespace App\Livewire\Provider;

use App\Models\History;
use App\Models\Request;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class UploadInvoice extends Component
{
    use WithFileUploads;

    public $open = false;

    public $request;

    public $invoice;

    public $date_loading;

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
            'date_loading' => 'required',
            'invoice' => 'required|file|mimes:png,jpg,pdf|max:10240',
        ],
        [
            'date_loading.required' => 'El campo fecha de carga es obligatorio',
            'invoice.required' => 'El campo factura es obligatorio',
            'invoice.file' => 'El campo factura debe ser un archivo',
            'invoice.mimes' => 'El campo factura debe ser un archivo de tipo: png, jpg o pdf',
            'invoice.max' => 'El campo factura no debe pesar más de 10MB',
        ]);

        //pendiente codigo azure
        $this->saveInvoice();

        $history = History::where('request_id', $this->request->id)
                            ->where('type_request', 'Solicitud nacional')
                            ->first();

        DB::beginTransaction();

        $this->request->update([
            'date_loading' => $this->date_loading,
            'status' => 3,
        ]);

        if ($this->request->id_request_double) {
            $requestDouble = Request::find($this->request->id_request_double);
            $requestDouble->update([
                'date_loading' => $this->date_loading,
                'status' => 3,
            ]);
        }

        $history->update([
            'status' => 3,
        ]);

        DB::commit();

        $this->open = false;
        $this->resetRequest();
        $this->dispatch('request-pending');
    }

    public function saveInvoice()
    {
        // Almacenar el archivo temporalmente
        $file = $this->invoice;
        $filePath = $file->store('temp'); // Almacena el archivo en una carpeta temporal
        $cacheKey = 'invoice_' . $this->request->id;

        // Guardar la ruta del archivo en la caché por 1 hora
        Cache::put($cacheKey, $filePath, 18000);


        // forma generada por copilot de 0
        /*// Generar un nombre único para el archivo
        $fileName = time() . '_' . $this->invoice->getClientOriginalName();

        // Subir el archivo a Azure Blob Storage
        $path = Storage::disk('azure')->put($fileName, file_get_contents($this->invoice->getRealPath()));

        // Retornar la ruta del archivo subido o hacer algo con ella
        session()->flash('message', 'Archivo subido exitosamente: ' . $path);*/


        // Obtener la extensión del archivo

        /*try {
            $extension = $this->invoice->getClientOriginalExtension();

            // Generar un nombre único para el archivo
            $fileName = md5(Str::random(5) . $this->invoice->getClientOriginalName() . time()) . '.' . $extension;

            // Definir el path de almacenamiento
            $path = 'invoice';

            // Almacenar el archivo en Azure Blob Storage
            $this->invoice->storeAs($path, $fileName, 'azure');

            // Crear un nuevo registro en la tabla invoices
            Invoice::create([
                'type_invoice' => $extension,
                'request_id' => $this->request->id,
                'attachment' => $path . '/' . $fileName,
            ]);
        } catch (\Exception $th) {
            $th;
        }*/
    }

    public function getInvoice($requestId)
    {
        $cacheKey = 'invoice_' . $requestId;
        $filePath = Cache::get($cacheKey);

        if ($filePath) {
            return Storage::download($filePath);
        } else {
            return response()->json(['error' => 'Archivo no encontrado o ha expirado'], 404);
        }
    }

    public function resetRequest()
    {
        $this->resetErrorBag();
        $this->reset(['invoice', 'date_loading']);
    }

    public function close()
    {
        $this->resetRequest();
        $this->open = false;
    }

    public function render()
    {
        return view('livewire.provider.upload-invoice');
    }
}
