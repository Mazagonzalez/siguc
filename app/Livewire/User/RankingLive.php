<?php

namespace App\Livewire\User;

use App\Models\History;
use Livewire\Component;

class RankingLive extends Component
{
    public $totalStates;

    protected $listeners = ['request' => 'generateRanking'];

    public function render()
    {
        $history = History::where('status', 5)->get();

        $providerNames = [];

        foreach ($history as $record) {
            if ($record->requestNational) {
                $providerNames[] = $record->requestNational->provider;
            }

            if ($record->requestThermoformed) {
                $providerNames[] = $record->requestThermoformed->provider;
            }

            if ($record->requestExportation) {
                $providerNames[] = $record->requestExportation->provider;
            }
        }

        $providerCounts = array_count_values($providerNames);

        // Calcular el total de estados
        $this->totalStates = array_sum($providerCounts);

        return view('livewire.user.ranking-live', [
            'totalStates' => $this->totalStates,
            'providerCounts' => $providerCounts,
        ]);
    }
}
