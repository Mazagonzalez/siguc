<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nit',
        'company_name',
        'operational_contact',
        'contact',
        'email',
    ];

    public function request()
    {
        return $this->hasMany(Request::class, 'provider_id');
    }

    public function requestThermoformed()
    {
        return $this->hasMany(RequestThermoformed::class, 'provider_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
