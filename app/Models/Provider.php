<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;

    protected $fillable = [
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
}
