<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'User',
            'email' => 'user@hot.co',
            'password' => bcrypt('1234'),
            'email_verified_at' => Carbon::now(),
            'remember_token'    => Str::random(10),
        ]);

        $user->assignRole('User');
    }
}
