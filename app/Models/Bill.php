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

    public function plateItems()
    {
        return $this->hasMany(Item::class)->where('cate','plate');
    }
    
// will has two plate if size of plate is diffrent
    public function successPlateItems()
    {
        return $this->hasMany(Item::class)->where(['cate'=>'plate','status'=>'success']);
    }

    public function failedPlateItems()
    {
        return $this->hasMany(Item::class)->where(['cate'=>'plate','status'=>'failed']);
    }

    public function extraItems()
    {
        return $this->hasMany(Item::class)->where(['cate'=>'extra']);
    }
    
}
