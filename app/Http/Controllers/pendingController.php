<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Device;
class pendingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
      $devices = Device::where('state','=','Pending')->get();
       return view('device.pending',compact('devices'));
    }

    public function show($id)
    {
        DB::table('devices')
        ->where('id', $id)
        ->update(['state' => 'rejected']);

        return redirect('/pending')->with('success','Device Is Rejected');
    }

    public function edit($id)
    {
       DB::table('devices')
        ->where('id', $id)
        ->update(['state' => 'Active']);

        return redirect('/pending')->with('success','Device Is Now Active ');
    }

}
