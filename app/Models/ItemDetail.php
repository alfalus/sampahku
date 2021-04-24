<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemDetail extends Model
{
    use HasFactory;

    protected $table = 'item_detail';
    protected $primaryKey = 'id_detail';
    public $timestamps = false;

    protected $fillable = [
        'id_mgt_item',
        'id_type_item',
        'description_item',
        'estimate_weight',
        'fixed_weight',
        'capture_image',
    ];
}
