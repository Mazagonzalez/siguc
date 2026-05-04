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

        //$response = Http::get('https://sigucapi-hahdhuh9dyetd7h6.canadacentral-01.azurewebsites.net/api/Providers');
        //if ($response->successful()) {
        //    $totalProvider = $response->json();
        $totalProvider = [
            [
                'nit' => '900123456-7',
                'company_name' => 'TransLogística Caribe S.A.S',
                'operational_contact' => 'Carlos Martínez',
                'contact' => '3001234567',
                'email' => 'operaciones@translogisticacaribe.com'
            ],
            [
                'nit' => '901987654-3',
                'company_name' => 'Carga Express del Norte Ltda',
                'operational_contact' => 'Laura Gómez',
                'contact' => '3017654321',
                'email' => 'contacto@cargaexpressnorte.com'
            ],
            [
                'nit' => '800456789-1',
                'company_name' => 'Logística Integral Andina S.A',
                'operational_contact' => 'Jorge Ramírez',
                'contact' => '3104567890',
                'email' => 'logistica@lia.com.co'
            ],
            [
                'nit' => '900654321-9',
                'company_name' => 'Transportes Rápidos del Magdalena S.A.S',
                'operational_contact' => 'Andrea Pérez',
                'contact' => '3206549871',
                'email' => 'servicio@transportesmagdalena.com'
            ],
            [
                'nit' => '901112223-4',
                'company_name' => 'Global Freight Colombia S.A.S',
                'operational_contact' => 'Luis Fernández',
                'contact' => '3112233445',
                'email' => 'info@globalfreightcolombia.com'
            ]
        ];

            foreach ($totalProvider as $providerData) {

                $duplicate = Provider::where('nit', $providerData['nit'])->first();
                if ($duplicate) {
                    //$this->command->info("Usuario duplciado con NIT: $duplicate->nit");
                    continue;
                }

                $userNit = limpiarNit($providerData['nit']);

                $user = User::create([
                    'name'              => $providerData['company_name'],
                    'email'             => $userNit,
                    'password'          => bcrypt('1234'),
                    'email_verified_at' => Carbon::now(),
                    'remember_token'    => Str::random(10),
                ]);

                Provider::create([
                    'user_id'             => $user->id,
                    'nit'                 => $providerData['nit'],
                    'company_name'        => $providerData['company_name'],
                    'operational_contact' => $providerData['operational_contact'],
                    'contact'             => $providerData['contact'],
                    'email'               => $providerData['email'],
                ]);

                $user->assignRole('Provider');
            }
        //}
    }
}
