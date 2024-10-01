<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    protected $fillable = [
        'provider',
        'provider_id',
        'client_name',
        'client_address',
        'client_phone',
        'container_type',
        'order_weight',
        'flete',
        'date_quotation',
        'comment',
        'type_vehicle',
        'license_plate',
        'driver_name',
        'identification',
        'date_acceptance',
        'date_loading',
        'status',
    ];

    //status 0: pendiente, 1: aceptado, 2: rechazado 3: finalizado

    public function provider()
    {
        return $this->belongsTo(Provider::class, 'provider_id');
    }
}
