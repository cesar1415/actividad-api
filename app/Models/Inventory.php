<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;
    protected $table = 'inventories';
    protected $primarykey = 'id';

    protected $fillable = [
        'product_id',
        'cuantity'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
