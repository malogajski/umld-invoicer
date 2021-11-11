<?php

namespace App\Models\Codebooks;

use App\Models\Host;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Associate extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'associates';

    protected $primaryKey = 'id';

    protected $fillable = [
        'host_id',
        'name',
        'type',
        'description',
        'address',
        'city_id',
        'state_id',
        'country_id',
        'registration_number',
        'pib',
        'phone',
        'mobile',
        'fax',
        'email',
        'web',
        'responsible_person',
        'status'
    ];

    protected $casts = [
        'id' => 'integer',
//        'city_id' => 'integer',
//        'state_id' => 'integer',
//        'country_id' => 'integer'
    ];

    protected $with = [
        'city',
        'state',
        'country'
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function host()
    {
        return $this->belongsTo(Host::class);
    }

//    public function getCityAttribute()
//    {
//
//    }
//
//    public function getStateAttribute()
//    {
//
//    }
//
//    public function getCountryAttribute()
//    {
//
//    }
}
