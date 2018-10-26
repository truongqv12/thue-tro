<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'districts';
    protected $primaryKey = 'dis_id';
    public $timestamps = false;
    protected $fillable = [
        'dis_name', 'dis_dvhc' , 'dis_cty_id'
    ];

    function city() {
        return $this->belongsTo(City::class, 'dis_cty_id', 'cty_id');
    }

    function wards() {
        return $this->hasMany(Wards::class, 'war_dis_id', 'dis_id');
    }

    function street() {
        return $this->hasMany(Street::class, 'str_dis_id', 'dis_id');
    }
}
