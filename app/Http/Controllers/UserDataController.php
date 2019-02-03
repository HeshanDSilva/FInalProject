<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Slider;
use App\Video;
use App\News;

class UserDataController extends Controller
{

public function showAdminAvatarPage()
  {
    $profile = Auth::user();
    $slider = Slider::all();
    $video = Video::all();
    $news = News::all();
    return view('Adminprofile',compact('profile','slider','video','news'));
  }

  public function showEditorAvatarPage()
    {
      $profile = Auth::user();
      $slider = Slider::all();
      $video = Video::all();
      $news = News::all();
      return view('Editorprofile',compact('profile','slider','video','news'));
    }

public function updateAvatar(Request $request){

  $this->validate($request,[
    'avatar'=>'required|image|mimes:jpeg,png,jpg|max:2048',
  ]);

  $user = Auth::user();

  $avatarName = $user->id.'_avatar'.time().'.'.request()->avatar->getClientOriginalExtension();
  $request->avatar->move(public_path(). '/images',$avatarName);
  $user->avatar = $avatarName;
  $user->save();

  return back()
      ->with('success','You have successfully uploaded image.');

}

  public function NewsAll()
  {
      $news = News::all();
      return view('user.AllNews',compact('news'));
  }

  public function SliderAll()
  {
      $image = Slider::all();
      return view('user.AllSlider',compact('image'));
  }

  public function VideoAll()
  {
      $video = Video::all();
      return view('user.AllVideo',compact('video'));
  }
}
