<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Statement extends Model
{
    protected $guarded =[];

    public function branch(){
        return $this->belongsTo(User::class,'branch_id');
    }
}
