<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndonesiaCity extends Model
{
    use HasFactory;

    protected $table = 'indonesia_cities';
    public $timestamps = true;
    protected $guarded = [];

    protected $appends = [
        'detail_position'
    ];
    public function getDetailPositionAttribute()
    {
        return json_decode($this->meta);
    }

    public function province(){
        return $this->belongsTo('App\Models\IndonesiaProvince','province_code','code');
    }
    public function districts()
    {
        return $this->hasMany('App\Models\IndonesiaDistrict', 'city_code','code');
    }
}
