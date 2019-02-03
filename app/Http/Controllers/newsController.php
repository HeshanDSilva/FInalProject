<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\News;
use App\User;
use Mail;
use App\Mail\SendEmail;
class newsController extends Controller
{
  public function showuploadForm(){
    $current = News::where('state', '=', 'Current' )->first();
    $pendings = News::where('state', '=', 'Pending' )->get();
    if($current == null){
      $data1['title1'] = 'Currently, The System Is Not Showing A News!';
      $data1['pendinghead1'] = '';
      $data1['pendingbody1'] = '';
      $data1['pendingtail1'] = '';
    }
    else{
      $data1['title1'] = 'The Currently Running News';
      $data1['pendinghead1'] = $current->head;
      $data1['pendingbody1'] = $current->body;
      $data1['pendingtail1'] = $current->tail;
    }
    $n=0;
    foreach($pendings as $pending){
      $n++;
    }

    if($n == 0){
      $data['title'] = 'No Pending News Availible';
    }
    else{
      $data['title'] = 'Pending news';
    }
    return view('news.newsUpload',$data,$data1,$n)->with('pendings',$pendings);
  }

  public function showManagePage()
  {
    $current = News::where('state', '=', 'Current' )->first();
    $pendings = News::where('state', '=', 'Pending' )->get();
    $rejected = News::where('state', '=', 'Rejected')->orderBy('updated_at', 'desc')->first();

    if($current == null){
      $data1['title1'] = 'Currently, The System Is Not Showing A News!';
      $data1['pendinghead1'] = '';
      $data1['pendingbody1'] = '';
      $data1['pendingtail1'] = '';
    }
    else{
      $data1['title1'] = 'The Currently Running News';
      $data1['pendinghead1'] = $current->head;
      $data1['pendingbody1'] = $current->body;
      $data1['pendingtail1'] = $current->tail;
    }

    $n=0;
    foreach($pendings as $pending){
      $n++;
    }
    if($n == 0){
        $data['title'] = 'No Pending News Availible';
    }
    else{
      $data['title'] = 'Pending News';

    }
    return view('news.ManageNews',$data,$data1,$n)->with('pendings',$pendings);
  }

  public function ChangeNews(request $req)
   {
      $current = News::where('state', '=', 'Current' )->first();
      $news = new News;
      if($req->head != null){
        $news->head = $req->head;
      }
      else{
        $news->head = $current->head;
      }
      if($req->body != null){
        $news->body = $req->body;
      }
      else{
        $news->body = $current->body;
      }
      if($req->tail != null){
        $news->tail=$req->tail;
      }
      else{
        $news->tail = $current->tail;
      }
      $news->AddedBy = Auth::user()->name;
      $news->state = "Pending";
      $news->save();

      $users = User::where('type','=','editor')->get();
      foreach ($users as $user) {
        $email = $user->email;
        $subject = 'New Pending News Availible';
        $massage = Auth::user()->name.' is added new news to the system. visit and check the new news';
        Mail::to($email)->send( new SendEmail($subject, $massage) );
      }
      return redirect('/Upload/news')->with('success','News Were Added!');
   }

   public function AcceptNews($id)
   {
     $news = News::find($id);
     $currentnews = News::where('state', 'Current', 1 )->first();
     {
       $news->state = "Current";
       $news->checkedBy = Auth::user()->name;
       $news->save();
     }
     {
       if($currentnews == null){
         ;
       }
       else{
         $currentnews->state = "Played";
         $currentnews->save();
       }

     }

     return redirect('/Manage/news')->with('success','Changes were recorded!');
   }

   public function RejectNews(request $req,$id)
   {
      $news = News::find($id);
      $news->state = "Rejected";
      $news->checkedBy = Auth::user()->name;
      $news->rejected_reason = $req->RemoveNews;
      $news->save();
      return redirect('/Manage/news')->with('success','Changes were recorded!');
   }


   public function RejectedNews($n)
   {
      $tuple = News::where('state','=','Rejected')->get();
      $m = 0;
      foreach ($tuple as $tuples){
        $m++;
      }
      if($m == 0){
          $data['title'] = "No Rejecteded News Available";
      }
      else{
          $data['title'] = "All Rejected News";
      }
      if($n == 1){
        return view('news.ShowRjectedNews',$data,compact('tuple'));
      }
      else if($n==2){
        return view('news.EShowRjectedNews',$data,compact('tuple'));
      }

   }

   public function PlayedNews($n)
   {
      $tuple = News::where('state','=','Played')->get();

      $m = 0;
      foreach ($tuple as $tuples){
        $m++;
      }
      if($m == 0){
          $data['title'] = "No Played News Available";
      }
      else{
          $data['title'] = "All Played News";
      }

      if($n == 1){
      return view('news.ShowPlayedNews',$data,compact('tuple'));
    }
    else if($n==2){
      return view('news.EShowPlayedNews',$data,compact('tuple'));
    }
   }

   public function deleteNews($id)
   {

      $news = News::where('id', $id)->first();
      $s = $news->state;
      $news->delete();
      if($s == 'Played'){
        return redirect('/played/news/1')->with('success','News Was permanently Deleted!');
      }
      else if($s == 'Rejected'){
        return redirect('/rejected/news/1')->with('success','News Was permanently Deleted!');
      }
      else {
          return redirect('/Upload/news')->with('success','News Was permanently Deleted!');
      }
   }

   public function ReplayNews($id)
   {
        $newNews = News::find($id);
        $newNews->state = "Pending";
        $newNews->AddedBy = Auth::user()->name;
        $newNews->save();

        foreach ($users as $user) {
          $email = $user->email;
          $subject = 'New Pending News Availible';
          $massage = Auth::user()->name.' is requested to replay a news which has already played. visit and check the new news';
          Mail::to($email)->send( new SendEmail($subject, $massage) );
        }

        return redirect('/Played/news/1')->with('success','Changes were recorded!');
   }

   public function EditNews(Request $request , $id)
   {

     $newNews = News::find($id);
     $s = $newNews->state;
     $newNews->head = $request->nhead;
     $newNews->body = $request->nbody;
     $newNews->tail = $request->ntail;
     $newNews->state = "Pending";
     $newNews->rejected_reason = null;
     $newNews->AddedBy = Auth::user()->name;
     $newNews->save();

     $users = User::where('type','=','editor')->get();
     foreach ($users as $user) {
       $email = $user->email;
       $subject = 'New Pending News Availible';
       $massage = Auth::user()->name.' is edited a news which was rejected. visit and check the new news';
       Mail::to($email)->send( new SendEmail($subject, $massage) );
     }
     if($s == 'Pending'){
       return redirect('/Upload/news')->with('success','Changes were recorded!');
     }
     else{
       return redirect('/rejected/news/1')->with('success','Changes were recorded!');
     }

   }
}
