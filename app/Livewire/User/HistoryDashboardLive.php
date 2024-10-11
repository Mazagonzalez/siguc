<?php

namespace App\Livewire\User;

use App\Models\History;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class HistoryDashboardLive extends Component
{
    public $requests = [];

    public $start_date;

    public $end_date;

    public $type;

    public $statu;

    public $show_modal_excel = null;

    public $option_export = null;

    public $dashboard = false;

    protected $listeners = ['request' => 'mount'];

    public function exportar()
    {
        $this->validate([
            'start_date' => 'nullable|before_or_equal:end_date',
            'end_date'   => 'nullable',
        ]);


        return redirect()->route('export.history', ['start_date' => $this->start_date,
            'end_date'                                           => $this->end_date,
            'statu'                                              => $this->statu,
            'type'                                               => $this->type,]);
    }

    public function closeModalExport()
    {
        $this->reset([
            'start_date',
            'end_date',
            'option_export',
            'statu',
        ]);
        $this->resetErrorBag();
        $this->show_modal_excel = false;
    }

    public function resetAllExport()
    {
        $this->reset([
            'start_date',
            'end_date',
            'statu',
        ]);

        $this->resetErrorBag();
    }

    public function render()
    {
        $items = History::whereIn('status', ([2,5]))->orderBy('updated_at', 'desc');

        if (!is_null($this->start_date) and !is_null($this->end_date) and $this->end_date < $this->start_date) {
            $this->addError('start_date', __('La fecha inicial debe ser una fecha anterior o igual a la fecha final.'));
        }

        if (!is_null($this->start_date) and !is_null($this->end_date) and $this->end_date >= $this->start_date) {
            $items->whereBetween(
                'updated_at',
                [$this->start_date . ' 00:00:00', $this->end_date . ' 23:59:59']
            );
        }

        $items->where(function ($query) {
            if ($this->type == 1) {
                $query->where('type_request', 'Solicitud nacional');
            }
            if ($this->type == 2) {
                $query->where('type_request', 'Solicitud termoformado');
            }
            if ($this->statu == 1) {
                $query->where('status', 5);
            }
            if ($this->statu == 2) {
                $query->where('status', 2);
            }

        });

        $requests = $items->get();

        return view('livewire.user.history-dashboard-live', ['requestsCollection' => $requests]);
    }
}
