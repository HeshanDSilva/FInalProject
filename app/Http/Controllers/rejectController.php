<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class rejectController extends Controller
{

    public function index()
    {
        $devices=\App\Device::where('state','=','rejected')->get();
        return view('device.reject',compact('devices'));
    }

    public function edit($id)
    {
        DB::table('devices')
        ->where('id', $id)
        ->update(['state' => 'Active']);

        return redirect('/reject');
    }

}
