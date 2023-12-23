<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'profile',
        'name',
        'email',
        'password',
        'plain_password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'updated_at',
        'email_verified_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function stocks()
    {
        return $this->hasMany(Stock::class, 'branch_id');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_role', 'user_id', 'role_id');
    }

    public function hasPermission($title)
    {
        $permission = Permission::where('title', $title)->first();

        //false if not exist
        if (!$permission) {
            return false;
        } else {
            $exist = DB::table('permission_user')
                ->where(['user_id' => $this->id, 'permission_id' => $permission->id])
                ->first();
            if (!$exist) {
                return false;
            }
        }
        return true;
    }
}
