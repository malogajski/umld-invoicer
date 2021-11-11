<?php

namespace App\Models\Invoices;

use App\Models\Codebooks\Associate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $with = [
        'associates',
        'details'
    ];

    public function associates(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Associate::class, 'associate_id');
    }

    public function details(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(InvoiceDetail::class, 'parent_id');
    }
}
