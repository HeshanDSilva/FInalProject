<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class ActiveUserController extends Controller
{

      public function index()
      {
          $users = DB::select('select * from users,devices where users.id = devices.user_id ');
           return view('user.activeusers',compact('users'));
      }

      public function edit($id)
      {
          DB::table('devices')
          ->where('user_id', $id)
          ->update(['state' => 'Deactive']);

         return redirect('/activeusers')->with('Now The User Is In Deactive Mode! ');
      }

}
