<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'order_activity';
    public $timestamps = false;
    
    protected $fillable = [
        'id_order',
        'id_mgt_item',
        'id_penyetor',
        'id_bank_sampah',
        'date_order',
        'distance',
        'vehicle',
        'description',
    ];
}
