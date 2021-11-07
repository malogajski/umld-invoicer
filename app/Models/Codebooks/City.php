<?php

namespace App\Models\Codebooks;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $fillable = [
        'name',
        'postcode',
        'state_id',
        'country'
    ];

    protected $appends = [
        'state',
    ];

    public function state()
    {
        return $this->belongsTo(State::class);
    }
}
