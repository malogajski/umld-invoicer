<?php

namespace App\Models;

use App\Models\Codebooks\City;
use App\Models\Codebooks\Country;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Host extends Model
{
    use HasFactory;

    protected $table = 'hosts';

    protected $primaryKey = 'id';

    protected $casts = [
        'id' => 'integer',
    ];

    protected $fillable = [
        'name',
        'description',
        'tax_id',
        'number_id',
        'address',
        'city_id',
        'country_id',
        'email',
        'web',
        'responsible_person',
        'phone',
        'mobile',
        'bank_account',
        'logo_img',
        'default_language'
    ];

    protected $with = [
        'city',
        'country',
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
