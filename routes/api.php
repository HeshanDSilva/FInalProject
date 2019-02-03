<?php

use Illuminate\Http\Request;
use App\Video;
use App\User;
use App\Slider;
use App\News;
use App\Test;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('video', function(){
    $data = Video::where('state','=','Accepted')->get();
    return json_encode($data);
});

Route::get('imageScreen1', function(){
    $data = Slider::where('state','=','Accepted')->where('screen','=','Screen_1')->get();
    return json_encode($data);
});

Route::get('imageScreen2', function(){
    $data = Slider::where('state','=','Accepted')->where('screen','=','Screen_2')->get();
    return json_encode($data);
});

Route::get('news', function(){
    $data = News::where('state','=','Current')->get();
    return json_encode($data);
});

Route::post('connectionerror', function(Request $request){
  DB::table('wifi_connections')->insert([['Token' => $request->name ,'user_id' => $request->id]]);
});

Route::post('logout', function(Request $request){
    $user = User::find($request->id);
    $user->online_state = 0;
    $user->save();
});
