<?php
use Illuminate\Http\Request;
use App\Video;
use App\User;
use App\Slider;
use App\News;
use App\Device;
//use Mail;
use App\Mail\SendEmail;
use Illuminate\Support\Facades\View;

/*-----Systems-------*/
Auth::routes();
Route::get('/', 'Auth\LoginController@showLoginForm');
Route::get('/admin', 'HomeController@addminview')->middleware('admin','revalidate');
Route::get('/editor', 'HomeController@editorview')->middleware('editor','revalidate');

/*-----News-------*/
Route::get('/Upload/news', 'newsController@showuploadForm')->middleware('admin','revalidate');
Route::get('/Manage/news', 'newsController@showManagePage')->middleware('editor','revalidate');
Route::post('/newsChange', 'newsController@ChangeNews')->middleware('admin','revalidate');
Route::get('/accept/news/{id}', 'newsController@AcceptNews')->middleware('editor','revalidate');
Route::post('/Editor/news/Reject/{id}', 'newsController@RejectNews')->middleware('editor','revalidate');
Route::get('/rejected/news/{n}', 'newsController@RejectedNews')->middleware('revalidate');
Route::get('/Played/news/{n}', 'newsController@PlayedNews')->middleware('revalidate');
Route::get('/delete/news/{id}', 'newsController@deleteNews')->middleware('admin','revalidate');
Route::get('/replay/news/{id}', 'newsController@ReplayNews')->middleware('admin','revalidate');
Route::post('/edit/news/{id}', 'newsController@EditNews')->middleware('admin','revalidate');

/*-----Sliders-------*/
Route::get('/Upload', 'slideController@showuploadForm')->middleware('admin','revalidate');
Route::post('/Upload/submit', 'slideController@StoresFile')->middleware('admin','revalidate');
Route::post('/edit/slide/{id}', 'slideController@EditSlider')->middleware('admin','revalidate');
Route::get('/Approved', 'slideController@showApprovedSlides')->middleware('admin','revalidate');
Route::get('/Pending', 'slideController@showPendingSlides')->middleware('admin','revalidate');
Route::get('/Rejected', 'slideController@showRejectedSlides')->middleware('admin','revalidate');
Route::get('/Editor/Pending', 'slideController@showEditorPendingSlides')->middleware('editor','revalidate');
Route::get('/Editor/Accepted', 'slideController@showEditorApprovedSlides')->middleware('editor','revalidate');
Route::get('/Editor/Rejected', 'slideController@showEditorRejectedSlides')->middleware('editor','revalidate');
Route::get('/Editor/Pending/Accept/{id}', 'slideController@AcceptSliders')->middleware('editor','revalidate');
Route::post('/Editor/Pending/Reject/{id}', 'slideController@RejectSliders')->middleware('editor','revalidate');
Route::get('/delete/slide/{id}', 'slideController@DeleteSliders')->middleware('admin','revalidate');
Route::post('/expand/slide/{id}', 'slideController@ExpandSliders')->middleware('admin','revalidate');

/*-----Users-------*/
Route::get('/Dashboard/ChangeAdminAvatar', 'UserDataController@showAdminAvatarPage')->middleware('admin','revalidate');
Route::get('/Dashboard/ChangeEditorAvatar', 'UserDataController@showEditorAvatarPage')->middleware('editor','revalidate');
Route::post('/Dashboard/updateAvatar', 'UserDataController@updateAvatar')->middleware('revalidate');

/*-----Devices-------*/
Route::get('/device/location','mapController@showMap')->middleware('admin','revalidate');


Route::get('/test', 'HomeController@test');

/*-----Videos-------*/
Route::get('/video/upload/form', 'videoController@ShowUploadForm')->middleware('admin','revalidate');
Route::get('/Admin/Pending-Videos', 'videoController@PendingVideos')->middleware('admin','revalidate');
Route::get('/Admin/approved-Videos', 'videoController@AppreovedVideos')->middleware('admin','revalidate');
Route::get('/Admin/rejected-Videos', 'videoController@RejectedVideos')->middleware('admin','revalidate');
Route::get('/Editor/Pending-Videos', 'videoController@EditorPendingVideos')->middleware('editor','revalidate');
Route::get('/Editor/rejected-Videos', 'videoController@EditorRejectedVideos')->middleware('editor','revalidate');
Route::get('/Editor/approved-Videos', 'videoController@EditorApprovedVideos')->middleware('editor','revalidate');
Route::get('/Editor/PendingVideo/Accept/{id}', 'videoController@AcceptVideos')->middleware('editor','revalidate');
Route::post('/Editor/PendingVideo/Reject/{id}', 'videoController@RejectVideos')->middleware('editor','revalidate');
Route::post('/edit/video/{id}', 'videoController@EditVideo')->middleware('admin','revalidate');
Route::post('/expand/video/{id}', 'videoController@ExpandVideo')->middleware('admin','revalidate');


//password reset
Route::get('/fogotton', 'mailController@home');
Route::post('send/email','mailController@sendemail');
Route::get('/resetfogotton/{token}', 'mailController@resethome');
Route::post('/resetfogotton/{token}','mailController@psupdate')->name('add');

Route::group(['middleware' => 'admin','revalidate'],function(){
  Route::resource('/categories','CategoryController');
  Route::resource('/UserDetails','UserDetailsController');
  Route::resource('/disabledusers','DisabledUserController');
  Route::resource('/activeusers','ActiveUserController');
  Route::resource('/device','deviceController');
  Route::resource('/pending','pendingController');
  Route::resource('/reject','rejectController');
  Route::post('/search','SearchController@search');
  Route::post('/searchuser','SearchController@searchuser');
  Route::post('/searchdesableuser','SearchController@searchdesableuser');
  Route::post('/devicesearch','SearchController@devicesearch');
  Route::post('/pendingsearch','SearchController@pendingsearch');
  Route::post('/rejectsearch','SearchController@rejectsearch');
  Route::post('/filter/sliders','SearchController@FilterSliders');
  Route::post('/filter/videos','SearchController@FilterVideos');
  Route::post('/filter/news','SearchController@FilterNews');
});


Route::post('/reset/password', 'Auth\PasswordResetController@reset')->middleware('revalidate');

/*Reporting*/
Route::get('/admin/all/news', 'UserDataController@NewsAll')->middleware('revalidate');
Route::get('/admin/all/sliders', 'UserDataController@SliderAll')->middleware('revalidate');
Route::get('/admin/all/videos', 'UserDataController@VideoAll')->middleware('revalidate');


Route::post('/upload/video', function(Request $request)
   {
     //Store in Youtube server
          $fullPathToVideo = $request->video;
          $title = $request->Title;
          $description = $request->Description;
          $video = Youtube::upload($fullPathToVideo, [
          'title'       => $title,
          'description' => $description,
          'tags'	      => ['foo', 'bar', 'baz'],
          'category_id' => 10
          ]);
      {
        //Insert into database
          $videos = new Video;
          $videos->video_id = $video->getVideoId();
          $videos->title = $request->Title;
          $videos->description = $request->Description;
          $videos->expired_date = $request->ExpireDate;
          $videos->state = "Pending" ;
          $videos->category = $request->Category;
          $videos->AddedBy = Auth::user()->name;
          $videos->save();
      }
      {
        /*Email*/
        $users = User::where('type','=','editor')->get();
        foreach ($users as $user) {
          $email = $user->email;
          $subject = 'New Pending Video Availible';
          $massage = Auth::user()->name.' is added a new video to the system. visit and check the new video';
          Mail::to($email)->send( new SendEmail($subject, $massage) );
        }
      }
          return redirect('/video/upload/form')->with('success','Video Uploaded');
});
Route::get('delete/video', function()
   {
      Youtube::delete('HvafXdyLOLc');
      return "HvafXdyLOLc";
});

/*-----------Notifications-----------*/

view::composer(['*'],function($view){
    $slider = Slider::where('state','=','Pending')->get();
    $s = 0;
    foreach($slider as $sliders){
           $s++;
    }
    $video = Video::where('state','=','Pending')->get();
    $v = 0;
    foreach($video as $videos){
           $v++;
    }
    $news = News::where('state','=','Pending')->get();
    $n = 0;
    foreach($news as $newss){
           $n++;
    }
    $device = News::where('state','=','Pending')->get();
    $d = 0;
    foreach($device as $devices){
           $d++;
    }

    $view->with('s',$s)
         ->with('n',$n)
         ->with('v',$v)
         ->with('d',$d);
});
