<?php

namespace App\Livewire\User;

use App\Models\History;
use Livewire\Component;

class ChartLive extends Component
{
    public $label = [];
    public $data = [];
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
        $totalStates = array_sum($providerCounts);

        $this->label = array_keys($providerCounts);

        $this->data = array_map(function ($count) use ($totalStates) {
            return ($totalStates > 0) ? round(($count / $totalStates) * 100, 2) : 0;
        }, array_values($providerCounts));

        return view('livewire.user.chart-live');
    }
}
