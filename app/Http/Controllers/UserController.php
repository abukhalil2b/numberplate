<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    /**-- index --*/
    public function index()
    {
        $users = User::whereNot('profile','branch')->get();

        return view('admin.user.index',compact('users'));
    }

}
