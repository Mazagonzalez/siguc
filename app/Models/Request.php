<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'provider',
        'provider_id',
        'order_number',
        'client_name',
        'client_address',
        'client_phone',
        'container_type',
        'order_weight',
        'gross_weight',
        'date_quotation',
        'comment',
        'type_vehicle',
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
        'decline_comment_user',
        'double_order',
        'id_request_double',
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
    public function request_double()
    {
        return $this->belongsTo(Request::class, 'id_request_double');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
