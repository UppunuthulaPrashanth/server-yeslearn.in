<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class AffliatePlans extends Model
{
    protected $fillable=[
        'rank',
        'label',
        'Description',
        'rank_amount_type',
        'rank_amount',
        'direct_commi',
        'partner_commi',
        'rank_color',
        'icon',
        'status'
    ];
}
