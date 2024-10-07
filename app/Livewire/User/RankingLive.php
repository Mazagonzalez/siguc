<?php

namespace App\Livewire\User;

use App\Models\Request;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class RankingLive extends Component
{
    public $type;
    public $providers = [];
    public $totalStates;

    protected $listeners = ['request' => 'generateRanking'];

    public function generateRanking()
    {
        $this->totalStates = Request::where('status', 4)->where('double_order', 0)->count();

        $this->providers = Request::select('provider_id', DB::raw('count(*) as total'))
            ->where('status', 4)
            ->where('double_order', 0)
            ->groupBy('provider_id')
            ->orderBy('total', 'desc')
            ->get();
    }

    public function mount()
    {
        $this->generateRanking();
    }

    public function render()
    {
        return view('livewire.user.ranking-live', [
            'totalStates' => $this->totalStates,
        ]);
    }
}
