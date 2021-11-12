<?php

namespace App\Models\Codebooks;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'products';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'description',
        'sku',
        'barcode',
        'price',
        'tax',
        'host_id',
        'unit',
        'product_category_id',
    ];


    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }
}
