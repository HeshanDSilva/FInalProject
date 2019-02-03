<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use FarhanWazir\GoogleMaps\GMaps;
use App\Device;
class mapController extends Controller
{
  public function showMap(){
    $device = Device::all();
    return view('location')->with('device',$device);
  }
}
