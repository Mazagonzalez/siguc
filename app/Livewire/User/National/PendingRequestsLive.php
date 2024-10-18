<?php

namespace App\Livewire\User\National;

use App\Models\Request;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class PendingRequestsLive extends Component
{
    public $requests = [];

    public $start_date;

    public $end_date;

    public $statu;

    protected $listeners = ['request' => 'mount'];

    public function closeModalExport()
    {
        $this->reset([
            'start_date',
            'end_date',
            'statu',
        ]);
        $this->resetErrorBag();
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
        $items = Request::where('user_id', Auth::id())->whereIn('status', [0, 1])->where('double_order', 0)->orderBy('updated_at', 'desc');

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
                $query->where('status', 0);
            }
            if ($this->statu == 2) {
                $query->orWhere('status', 1);
            }
        });

        $requests = $items->paginate(5);

        return view('livewire.user.national.pending-requests-live', ['requestsCollection' => $requests]);
    }
}
