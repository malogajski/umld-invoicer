<?php

namespace App\Models\Invoices;

use App\Models\Host;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvoiceType extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'invoice_types';

    protected $primaryKey = 'id';

    protected $fillable = [
        'host_id',
        'name',
        'prefix'
    ];

    public function host()
    {
        $this->belongsTo(Host::class);
    }
}
