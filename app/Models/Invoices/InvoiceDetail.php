<?php

namespace App\Models\Invoices;

use App\Http\Controllers\Invoices\InvoicesDetailController;
use App\Models\Codebooks\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvoiceDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $with = [
        'products',
    ];

    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
