<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Street extends Model
{
    protected $table = 'streets';
    protected $primaryKey = 'str_id';
    public $timestamps = false;
    protected $fillable = [
        'str_name', 'str_dis_id'
    ];

    function district() {
        return $this->belongsTo(District::class, 'str_dis_id', 'dis_id');
    }

}
