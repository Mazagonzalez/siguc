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
        $history = History::where('status', 5)->with([
            'requestNational.provider',
            'requestThermoformed.provider',
            'requestExportation.provider'
        ])->get();

        $providerData = [];
        $providerFleteTotal = [];

        foreach ($history as $record) {
            if ($record->requestNational) {
                $provider = $record->requestNational->provider;
                $providerData[] = $provider;
                $providerFleteTotal[$provider] = ($providerFleteTotal[$provider] ?? 0) + $record->requestNational->final_flete;
            }

            if ($record->requestThermoformed) {
                $provider = $record->requestThermoformed->provider;
                $providerData[] = $provider;
                $providerFleteTotal[$provider] = ($providerFleteTotal[$provider] ?? 0) + $record->requestThermoformed->final_flete;
            }

            if ($record->requestExportation) {
                $provider = $record->requestExportation->provider;
                $providerData[] = $provider;
                $providerFleteTotal[$provider] = ($providerFleteTotal[$provider] ?? 0) + $record->requestExportation->total_final_flete;
            }
        }

        $providerCounts = array_count_values($providerData);

        arsort($providerCounts);

        return view('livewire.user.ranking-live', [
            'providerCounts' => $providerCounts,
            'providerFleteTotal' => $providerFleteTotal,
        ]);
    }

}
