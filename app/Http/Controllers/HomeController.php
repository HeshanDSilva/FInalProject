<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Slider;
use Illuminate\Support\Facades\Auth;
use App\Video;
use App\News;
use DB;
use App\Device;
use App\Category;
use Illuminate\Support\Facades\View;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function addminview()

    {
      $user = User::all();
      $image = Slider::all();
      $dvideo = Video::all();
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
      return view('AddminDashboardContent',compact('user','image','dvideo','news','device'))->with('type',json_encode($array))
                                                                                  ->with('location',json_encode($array1))
                                                                                  ->with('dealer',json_encode($dealer))
                                                                                  ->with('distributor',json_encode($distributor))
                                                                                  ->with('retail',json_encode($retail));
    }

    public function loginview()
    {
        return view('login');
    }

    public function editorview()
    {
            $user = User::all();
            $image = Slider::all();
            $dvideo = Video::all();
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
            return view('EditorDashboardContent',compact('user','image','dvideo','news','device'))->with('type',json_encode($array))
                                                                                        ->with('location',json_encode($array1))
                                                                                        ->with('dealer',json_encode($dealer))
                                                                                        ->with('distributor',json_encode($distributor))
                                                                                        ->with('retail',json_encode($retail));

    }

    public function test()
    {
        $category = Category::all();
        $user = User::all();
        $image = Slider::all();
        $dvideo = Video::all();

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
        return view('test',compact('user','image','dvideo','news','category'))->with('type',json_encode($array))
                                                                                    ->with('location',json_encode($array1))
                                                                                    ->with('dealer',json_encode($dealer))
                                                                                    ->with('distributor',json_encode($distributor))
                                                                                    ->with('retail',json_encode($retail));
    }
}
