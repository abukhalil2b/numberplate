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
        'en_name',
        'ar_name',
        'email',
        'phone',
        'description',
        'password',
        'child_email',
        'imei',
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


    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_user', 'user_id', 'permission_id');
    }

    public function hasRole($id)
    {
        return $this->roles()->where('user_role.role_id', $id)->count();
    }

    public function permission($permission)
    {
   
        $userHasPermission = $this->permissions()->where('title', $permission)->count();

        $userRolesHasPermission = $this->roles()->whereHas('permissions', function ($query) use ($permission) {
            $query->where('permissions.title', $permission);
        })->count();

        if ($userHasPermission || $userRolesHasPermission || $this->id === 1) {
            return true;
        } else {
            return false;
        }
    }
}
