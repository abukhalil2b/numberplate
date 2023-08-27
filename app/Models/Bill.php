<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $guarded = [];

    public function branch()
    {
        return $this->belongsTo(User::class, 'branch_id');
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
