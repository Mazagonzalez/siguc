<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proforma extends Model
{
    use HasFactory;

    protected $fillable = [
        'proforma_id',
        'user_id',
        'provider',
        'provider_id',
        'order_number',
        'client_name',
        'client_address',
        'client_phone',
        'type_vehicle',
        'net_weight',
        'gross_weight',
        'container_type',
        'date_quotation',
        'comment',
        'initial_flete',
        'license_plate',
        'driver_name',
        'driver_phone',
        'identification',
        'final_flete',
        'status',
    ];
}
