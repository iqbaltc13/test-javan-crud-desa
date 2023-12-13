<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndonesiaDistrict extends Model
{
    use HasFactory;

    protected $table = 'indonesia_districts';
    public $timestamps = true;
    protected $guarded = [];

    protected $appends = [
        'detail_position'
    ];
    public function getDetailPositionAttribute()
    {
        return json_decode($this->meta);
    }
    
    public function city(){
        return $this->belongsTo('App\Models\IndonesiaCity','city_code','code');
    }
    public function villages()
    {
        return $this->hasMany('App\Models\IndonesiaVillage', 'district_code','code');
    }
}
