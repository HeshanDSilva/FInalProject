<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Device;
class deviceController extends Controller
{
    public function index()
    {
        $devices=Device::where('state','=','Active')->get();
        return view('device.index',compact('devices'));
    }
}
