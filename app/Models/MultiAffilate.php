<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MultiAffilate extends Model
{
    protected $fillable=[
        'director_id',
        'partner_id',
        'sale_id',
        'status'
    ];
}
