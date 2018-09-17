<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'use_id';
    protected $fillable = [
        'use_name', 'use_email', 'use_password', 'use_avatar', 'use_birthdays', 'use_phone', 'use_address', 'use_status', 'create_date'
    ];

    protected $hidden = [
        'use_password', 'remember_token',
    ];
}
