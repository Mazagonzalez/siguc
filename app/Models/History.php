<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_request',
        'request_id',
        'request_thermoformed_id',
        'request_export_id',
        'status',
    ];

    public function requestNational()
    {
        return $this->belongsTo(Request::class, 'request_id');
    }

    public function requestThermoformed()
    {
        return $this->belongsTo(RequestThermoformed::class, 'request_thermoformed_id');
    }

    public function requestExport()
    {
        return $this->belongsTo(RequestExport::class, 'request_export_id');
    }
}
