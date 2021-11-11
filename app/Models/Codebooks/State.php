<?php

namespace App\Models\Codebooks;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    protected $table = 'states';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'country_id'
    ];

    protected $with = [
        'country'
    ];

    public function cities()
    {
        return $this->hasMany(City::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
