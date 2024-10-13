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
        'order_number',
        'client_name',
        'client_address',
        'client_phone',
        'type_vehicle',
        'total_net_weight',
        'total_gross_weight',
        'vehicle_quantity',
        'comment',
        'date_quotation',
        'order_quantity',
        'status',
    ];

    public function history()
    {
        return $this->hasMany(History::class);
    }
}
