<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DisabledUserController extends Controller
{

    public function index()
    {
        $users = DB::select('select * from users,devices where users.id = devices.user_id ');
         return view('user.disabled',compact('users'));
    }

    public function edit($id)
    {
        DB::table('devices')
        ->where('user_id', $id)
        ->update(['state' => 'Active']);

       return redirect('/disabledusers')->with('Now The User Is In Active Mode! ');
    }

}
