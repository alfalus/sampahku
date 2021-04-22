<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $table = 'management_item';
    protected $primaryKey = 'id_mgt_item';
    public $timestamps = false;

    protected $fillable = [
        'id_mgt_item',
        'id_penyetor',
        'id_type_item',
        'description_item',
        'estimate_weight',
        'fixed_weight',
        'capture_image',
    ];
}
