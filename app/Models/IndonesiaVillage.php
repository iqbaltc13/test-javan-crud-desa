<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndonesiaVillage extends Model
{
    use HasFactory;

    protected $table = 'indonesia_villages';
    public $timestamps = true;
    protected $guarded = [];

    protected $appends = [
        'detail_position'
    ];
    public function getDetailPositionAttribute()
    {
        return json_decode($this->meta);
    }

    public function district(){
        return $this->belongsTo('App\Models\IndonesiaDistrict','district_code','code');
    }
    
}
