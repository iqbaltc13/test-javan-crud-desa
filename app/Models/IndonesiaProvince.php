<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndonesiaProvince extends Model
{
    use HasFactory;

    protected $table = 'indonesia_provinces';
    public $timestamps = true;
    protected $guarded = [];

    protected $appends = [
        'detail_position'
    ];
    public function getDetailPositionAttribute()
    {
        return json_decode($this->meta);
    }

    public function cities()
    {
        return $this->hasMany('App\Models\IndonesiaCity', 'province_code','code');
    }
}
