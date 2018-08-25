<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'cities';
    protected $primaryKey = 'cty_id';
    protected $fillable = [
        'cty_name', 'cty_slug'
    ];
}
