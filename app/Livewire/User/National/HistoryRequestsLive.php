<?php

namespace App\Livewire\User\National;

use App\Models\Request;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class HistoryRequestsLive extends Component
{
    public $requests = [];

    public $start_date;

    public $end_date;

    public $statu;

    public $show_modal_excel = null;

    public $option_export = null;

    public $dashboard = false;

    protected $listeners = ['request-history' => 'mount'];

    public function exportar()
    {
        $this->validate([
            'start_date' => 'nullable|before_or_equal:end_date',
            'end_date'   => 'nullable',
        ]);


        return redirect()->route('export.request', ['start_date' => $this->start_date,
            'end_date'                                           => $this->end_date,
            'statu'                                              => $this->statu,]);
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
        $items = Request::where('user_id', Auth::id())->whereIn('status', [2, 5])->where('double_order', 0)->orderBy('updated_at', 'desc');

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
            if ($this->statu == 1) {
                $query->where('status', 5);
            }
            if ($this->statu == 2) {
                $query->orWhere('status', 2);
            }
        });

        $requests = $items->paginate(5);

        return view('livewire.user.national.history-requests-live', ['requestsCollection' => $requests]);
    }
}
