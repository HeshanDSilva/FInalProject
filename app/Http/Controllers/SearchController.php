<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use App\Device;
use App\Slider;
use App\Video;
use App\News;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
class SearchController extends Controller
{


public function searchuser(Request $request){
 $q = Input::get ( 'search' );
 $user = User::where ( 'name', 'LIKE', '%' . $q . '%' )->orWhere ( 'email', 'LIKE', '%' . $q . '%' )->orWhere ( 'type', 'LIKE', '%' . $q . '%' )->get ();
 if (count ( $user ) > 0)
     return view ( 'user.searchuser' )->withDetails ( $user )->withQuery ( $q );
 else
     return view ( 'user.searchuser' )->withMessage ( 'No Details found. Try to search again !' );
}

public function devicesearch(Request $request){
    $q = Input::get ( 'search' );
    $device = Device::where ( 'location', 'LIKE', '%' . $q . '%' )->orWhere ( 'category', 'LIKE', '%' . $q . '%' )->get ();
    if (count ( $device ) > 0)
    return view ( 'device.devicesearch' )->withDetails ( $device )->withQuery ( $q );
    else
     return view ( 'device.devicesearch' )->withMessage ( 'No Details found. Try to search again !' );
}


public function pendingsearch(Request $request){
    $q = Input::get ( 'search' );
    $device = Device::where ( 'location', 'LIKE', '%' . $q . '%' )->orWhere ( 'id', 'LIKE', '%' . $q . '%' )->orWhere ( 'category', 'LIKE', '%' . $q . '%' )->get ();
    if (count ( $device ) > 0)
    return view ( 'device.pendingsearch' )->withDetails ( $device )->withQuery ( $q );
    else
     return view ( 'device.pendingsearch' )->withMessage ( 'No Details found. Try to search again !' );
}

public function rejectsearch(Request $request){
    $q = Input::get ( 'search' );
    $device = Device::where ( 'location', 'LIKE', '%' . $q . '%' )->orWhere ( 'id', 'LIKE', '%' . $q . '%' )->orWhere ( 'category', 'LIKE', '%' . $q . '%' )->get ();
    if (count ( $device ) > 0)
    return view ( 'device.rejectsearch' )->withDetails ( $device )->withQuery ( $q );
    else
     return view ( 'device.rejectsearch' )->withMessage ( 'No Details found. Try to search again !' );
}

public function FilterSliders(Request $request)
{
    $sd = $request->startdate;
    $ed = $request->enddate;
    $image = Slider::whereBetween('updated_at', [$sd." 00:00:00", $ed." 23:59:59"])->get();
    return view('user.AllSlider',compact('image'));
}

public function FilterVideos(Request $request)
{
  $sd = $request->startdate;
  $ed = $request->enddate;
  $video = Video::whereBetween('updated_at', [$sd." 00:00:00", $ed." 23:59:59"])->get();
  return view('user.AllVideo',compact('video'));
}

public function FilterNews(Request $request)
{
  $sd = $request->startdate;
  $ed = $request->enddate;
  $news = News::whereBetween('updated_at', [$sd." 00:00:00", $ed." 23:59:59"])->get();
  return view('user.AllNews',compact('news'));
}

}
