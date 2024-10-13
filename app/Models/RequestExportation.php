<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestExportation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'provider',
        'provider_id',
        'proforma_id',
        'client_name',
        'client_address',
        'client_phone',
        'type_vehicle',
        'total_net_weight',
        'total_gross_weight',
        'vehicle_quantity',
        'date_quotation',
        'comment',
        'initial_flete',
        'date_acceptance',
        'time_response',
        'final_flete',
        'delivery_commentary',
        'date_loading',
        'date_decline',
        'decline_comment',
        'user_decline_comment',
        'order_quantity',
        'status',
    ];

    public function history()
    {
        return $this->hasMany(History::class);
    }
}
