<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;
use App\Slider;
use App\Video;
use App\News;
use DB;
use App\device;

class LoginController extends Controller
{
  public function showLoginForm(){
      return view('login');
  }


  public function login(request $request){

    $image = Slider::all();
    $dvideo = Video::all();
    $news = News::all();
    $device = Device::all();

    $news = News::all();
    $data = DB::table('users')
      -> select(
        DB::raw('type as type'),
        DB::raw('count(*) as number'))
      -> groupBy('type')
      -> get();

    $array[]=['type','number'];
    foreach($data as $key => $value )
    {
      $array[++$key] = [$value->type,$value->number];
    };


    $data1 = DB::table('devices')
      -> select(
        DB::raw('location as location'),
        DB::raw('count(*) as number1'))
      -> groupBy('location')
      -> get();

    $array1[]=['location','number1'];
    foreach($data1 as $key1 => $value1 )
    {
      $array1[++$key1] = [$value1->location,$value1->number1];
    };

    $show1 = Slider::where('category', '=', 'Distributor' )->get();
    $n1 = 0;
    foreach ($show1 as $show1s){
      $n1++;
    }
    $video1 = Video::where('category', '=', 'Distributor' )->get();
    $m1 = 0;
    foreach ($video1 as $video1s){
      $m1++;
    }

    $distributor[0]=['Data1','count1'];
    $distributor[1]=['Slider',$n1];
    $distributor[2]=['Video',$m1];

    $show = Slider::where('category', '=', 'Dealer' )->get();
    $n = 0;
    foreach ($show as $shows){
      $n++;
    }
    $video = Video::where('category', '=', 'Dealer' )->get();
    $m = 0;
    foreach ($video as $videos){
      $m++;
    }

    $dealer[0]=['Data','count'];
    $dealer[1]=['Slider',$n];
    $dealer[2]=['Video',$m];

    $show2 = Slider::where('category', '=', 'Retail' )->get();
    $n2 = 0;
    foreach ($show2 as $show2s){
      $n2++;
    }
    $video2 = Video::where('category', '=', 'Retail' )->get();
    $m2 = 0;
    foreach ($video2 as $video2s){
      $m2++;
    }

    $retail[0]=['Data2','count2'];
    $retail[1]=['Slider',$n2];
    $retail[2]=['Video',$m2];

    if($request->IsMethod('post')){
        $data = $request->input();
        if(Auth::attempt([ 'email'=>$data['email'], 'password'=>$data['password'], 'type'=>'admin'], $request->remember)){
          $user = User::all();
          $online = User::find(Auth::user()->id);
          $online->online_state = 1;
          $online->save();
          return view('AddminDashboardContent',compact('user','image','dvideo','news','device'))->with('type',json_encode($array))
                                                                                      ->with('location',json_encode($array1))
                                                                                      ->with('dealer',json_encode($dealer))
                                                                                      ->with('distributor',json_encode($distributor))
                                                                                      ->with('retail',json_encode($retail));

        }
       else if(Auth::attempt([ 'email'=>$data['email'], 'password'=>$data['password'], 'type'=>'editor'], $request->remember)){
         $user = User::all();
         $online = User::find(Auth::user()->id);
         $online->online_state = 1;
         $online->save();

        return view('EditorDashboardContent',compact('user','image','dvideo','news','device'))->with('type',json_encode($array))
                                                                                    ->with('location',json_encode($array1))
                                                                                    ->with('dealer',json_encode($dealer))
                                                                                    ->with('distributor',json_encode($distributor))
                                                                                    ->with('retail',json_encode($retail));

      }
        else{
        return redirect('/login')->with('success',' Invalid Username, Job_Type or password ');
        }
       return redirect()->back()
       ->withInput($request->only($this->username(), 'remember'));

    }
    }


public function logout(Request $request) {
  $online = User::find(Auth::user()->id);
  $online->online_state = 0;
  $online->save();
  Auth::logout();
  return redirect('/login');
}

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
