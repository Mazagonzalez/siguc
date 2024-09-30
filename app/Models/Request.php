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
        'date_quotation',
        'comment',
        'status',
    ];

    public function provider()
    {
        return $this->belongsTo(Provider::class, 'provider_id');
    }
}
