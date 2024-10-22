<?php

namespace App\Livewire\User\Thermoformed;

use App\Models\History;
use App\Models\Invoice;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use App\Models\RequestThermoformed;

class ConfirmDeliveryLive extends Component
{
    use WithFileUploads;

    public $open = false;

    public $request;

    public $final_flete;

    public $completed;

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
            'completed' => 'required|file|mimes:png,jpg,pdf|max:10240',
        ],
        [
            'final_flete.required' => 'El campo flete final es obligatorio',
            'completed.required' => 'El campo factura es obligatorio',
            'completed.file' => 'El campo factura debe ser un archivo',
            'completed.mimes' => 'El campo factura debe ser un archivo de tipo: png, jpg o pdf',
            'completed.max' => 'El campo factura no debe pesar más de 10MB',
        ]);

        //pendiente codigo azure
        //$this->saveCompleted();
        $this->final_flete = str_replace('.', '', $this->final_flete);

        $history = History::where('request_thermoformed_id', $this->request->id)
                            ->where('type_request', 'Solicitud termoformado')
                            ->first();

        DB::beginTransaction();

        $this->request->update([
            'status' => 4,
            'final_flete' => $this->final_flete,
            'delivery_commentary' => $this->delivery_commentary,
        ]);

        $history->update([
            'status' => 4,
        ]);

        DB::commit();

        $this->open = false;
        $this->resetRequest();
        $this->dispatch('request-pending');
    }

    public function saveCompleted()
    {
        // forma generada por copilot de 0
        /*// Generar un nombre único para el archivo
        $fileName = time() . '_' . $this->completed->getClientOriginalName();

        // Subir el archivo a Azure Blob Storage
        $path = Storage::disk('azure')->put($fileName, file_get_contents($this->completed->getRealPath()));

        // Retornar la ruta del archivo subido o hacer algo con ella
        session()->flash('message', 'Archivo subido exitosamente: ' . $path);*/


        // Obtener la extensión del archivo

        /*try {
            $extension = $this->completed->getClientOriginalExtension();

            // Generar un nombre único para el archivo
            $fileName = md5(Str::random(5) . $this->completed->getClientOriginalName() . time()) . '.' . $extension;

            // Definir el path de almacenamiento
            $path = 'completed';

            // Almacenar el archivo en Azure Blob Storage
            $this->completed->storeAs($path, $fileName, 'azure');

            // Crear un nuevo registro en la tabla invoices
            Invoice::create([
                'type_invoice' => $extension,
                'request_id' => $this->request->id,
                'attachment' => $path . '/' . $fileName,
                'flete' => $this->final_flete,
            ]);
        } catch (\Exception $th) {
            $th;
        }*/
    }

    public function resetRequest()
    {
        $this->resetErrorBag();
        $this->reset([
            'final_flete',
            'completed',
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
        return view('livewire.user.thermoformed.confirm-delivery-live');
    }
}
