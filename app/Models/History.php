<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_request',
        'user_id',
        'provider_id',
        'request_id',
        'request_thermoformed_id',
        'request_exportation_id',
        'status',
    ];

    /*status
    0: pendiente
    1: aceptado
    2: rechazado
    3: facturado
    4: confirmado o cumplido
    5: finalizado*/

    public function requestNational()
    {
        return $this->belongsTo(Request::class, 'request_id');
    }

    public function requestThermoformed()
    {
        return $this->belongsTo(RequestThermoformed::class, 'request_thermoformed_id');
    }

    public function requestExportation()
    {
        return $this->belongsTo(RequestExportation::class, 'request_exportation_id');
    }
}
