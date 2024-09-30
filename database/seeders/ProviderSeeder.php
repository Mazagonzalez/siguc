<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Provider;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        function limpiarNit($nit) {
            // Eliminar los puntos
            $nit = str_replace('.', '', $nit);

            // Eliminar el guion y el número que sigue
            $nit = preg_replace('/-\d+$/', '', $nit);

            return $nit;
        }

        $response = Http::get('https://sigucapi-hahdhuh9dyetd7h6.canadacentral-01.azurewebsites.net/api/Providers');
        if ($response->successful()) {
            $totalProvider = $response->json();

            foreach ($totalProvider as $providerData) {

                $duplicate = Provider::where('nit', $providerData['nit'])->first();
                if ($duplicate) {
                    //$this->command->info("Usuario duplciado con NIT: $duplicate->nit");
                    continue;
                }

                Provider::create([
                    'nit'                 => $providerData['nit'],
                    'company_name'        => $providerData['company_name'],
                    'operational_contact' => $providerData['operational_contact'],
                    'contact'             => $providerData['contact'],
                    'email'               => $providerData['email'],
                ]);

                $userNit = limpiarNit($providerData['nit']);

                $user = User::create([
                    'name'              => $providerData['company_name'],
                    'email'             => $userNit,
                    'password'          => bcrypt('1234'),
                    'email_verified_at' => Carbon::now(),
                    'remember_token'    => Str::random(10),
                ]);

                $user->assignRole('Provider');
            }
        }
    }
}
