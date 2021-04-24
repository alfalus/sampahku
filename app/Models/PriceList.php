<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceList extends Model
{
    use HasFactory;

    protected $table = 'price_list';
    protected $primaryKey = 'id_type_item';
    // public $timestamps = false;
    
    protected $fillable = [
        'id_type_item',
        'type_item',
        'price_weight'
    ];
}
