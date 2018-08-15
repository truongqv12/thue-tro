<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'admin_user';
    protected $primaryKey = 'adm_id';
    protected $fillable = [
        'adm_login_name', 'adm_name', 'adm_password', 'adm_email', 'adm_phone', 'adm_avatar', 'adm_email', 'admin_id', 'adm_active', 'adm_add', 'adm_edit', 'adm_delete', 'create_date'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'adm_password', 'remember_token',
    ];
    public function getAuthPassword () {
        return $this->adm_password;
    }
}
