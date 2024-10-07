<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestThermoformed extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'provider',
        'provider_id',
        'client_name',
        'client_address',
        'client_phone',
        'city',
        'type_vehicle',
        'container_type',
        'box_quantity',
        'date_quotation',
        'comment',
        'license_plate',
        'driver_name',
        'driver_phone',
        'identification',
        'initial_flete',
        'date_acceptance',
        'time_response',
        'final_flete',
        'delivery_commentary',
        'date_loading',
        'date_decline',
        'decline_comment',
        'user_decline_comment',
        'status',
    ];

    /*status
    0: pendiente
    1: aceptado
    2: rechazado
    3: confirmado
    4: finalizado*/

    public function provider()
    {
        return $this->belongsTo(Provider::class, 'provider_id');
    }

    //relacion uno a mucho inversa

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
