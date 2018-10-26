<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wards extends Model
{
    protected $table = 'wards';
    protected $primaryKey = 'war_id';
    public $timestamps = false;
    protected $fillable = [
        'war_name', 'war_dvhc', 'war_dis_id'
    ];

    function district() {
        return $this->belongsTo(District::class, 'war_dis_id', 'dis_id');
    }
}
