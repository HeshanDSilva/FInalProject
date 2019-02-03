<?php

namespace App\Http\Controllers;
use App\Video;
use App\User;
use App\Category;
use Illuminate\Http\Request;
use Dawson\Youtube\Youtube;
use Illuminate\Support\Facades\Auth;
class videoController extends Controller
{
    public function ShowUploadForm()
    {
        $category = Category::all();
        return view('videos.VideoUpload',compact('category'));
    }

    public function PendingVideos()
    {
      $video = Video::where('state', '=', 'Pending' )->get();
      $n = 0;
      foreach ($video as $videos){
        $n++;
      }
      if($n == 0){
        $data['title'] = "No Pending Videos Available";
        return view('videos.AdminVideoPending',$data,compact('video'));
      }
      $data['title'] = "All Pending Videos";
      return view('videos.AdminVideoPending',$data,compact('video'));
    }

    public function EditorPendingVideos()
    {
      $video = Video::where('state', '=', 'Pending' )->get();
      $n = 0;
      foreach ($video as $videos){
        $n++;
      }
      if($n == 0){
        $data['title'] = "No Pending Videos Available";
        return view('videos.EditorVideoPending',$data,compact('video'));
      }
      $data['title'] = "All Pending Videos";
      return view('videos.EditorVIdeoPending',$data,compact('video'));
    }

    public function AppreovedVideos()
    {
      $video = Video::where('state', '=', 'Accepted' )->get();
      $n = 0;
      foreach ($video as $videos){
        $n++;
      }
      if($n == 0){
          $data['title'] = "No Approved Videos Available";
          return view('videos.AdminVideoAccepted',$data,compact('video'));
      }
      $data['title'] = "All Approved Videos";
      return view('videos.AdminVideoAccepted',$data,compact('video'));
    }

    public function EditorApprovedVideos(){
      $video = Video::where('state', '=', 'Accepted' )->get();
      $n = 0;
      foreach ($video as $videos){
        $n++;
      }
      if($n == 0){
          $data['title'] = "No Approved Videos Available";
          return view('videos.EditorVideoApproved',$data,compact('video'));
      }
      $data['title'] = "All Approved Videos";
      return view('videos.EditorVideoApproved',$data,compact('video'));
    }

    public function RejectedVideos()
    {
      $video = Video::where('state', '=', 'Rejected' )->get();
      $n = 0;
      foreach ($video as $videos){
        $n++;
      }
      if($n == 0){
        $data['title'] = "No Rejected Videos Available";
        return view('videos.AdminVideoRejected',$data,compact('video'));
      }
      $data['title'] = "All Rejected Videos";
      return view('videos.AdminVideoRejected',$data,compact('video'));
    }

    public function EditorRejectedVideos()
    {
      $video = Video::where('state', '=', 'Rejected' )->get();
      $n = 0;
      foreach ($video as $videos){
        $n++;
      }
      if($n == 0){
          $data['title'] = "No Rejected Videos Available";
          return view('videos.EditorVideoRejected',$data,compact('video'));
      }
      $data['title'] = "All Rejected Videos";
      return view('videos.EditorVideoRejected',$data,compact('video'));
    }

    public function AcceptVideos($id){
    {
        $video = Video::find($id);
        $video->state = 'Accepted';
        $video->CheckedBy = Auth::user()->name;
        $video->save();
    }
        return redirect('/Editor/Pending-Videos')->with('success','State Changed, Move To Accept Folder');
    }

    public function RejectVideos(request $request,$id)
    {
      $video = Video::find($id);
      $video->rejected_reason=$request->RemoveVideo;
      $video->state = 'Rejected';
      $video->CheckedBy = Auth::user()->name;
      $video->save();
      return redirect('/Editor/Pending-Videos')->with('success','Reason Saved, Move To Reject Folder');

    }

    public function DeleteVideos($id)
    {
      $video = Video::where('id','=', $id)->first();
      $V = $video->state;
      Video::where('id','=', $id)->delete();
      if($V == 'Pending'){
        return redirect('/Admin/Pending-Videos')->with('success','Video Was permanently Deleted!');
      }
      else if($V == 'Rejected'){
        return redirect('/Admin/rejected-Videos')->with('success','Video Was permanently Deleted!');
      }
      else if($V == 'Accepted'){
        return redirect('/Admin/approved-Videos')->with('success','Video Was permanently Deleted!');
      }
      else {
        ;
      }
    }

    public function EditVideo(request $request , $id)
    {

        $this->validate($request,[
          'Category'=>'required',
          'ExpireDate'=>'required|date|after:today',
        ]);

          $video = Video::find($id);
          $s = $video->state;
          $video->category = $request->Category;
          $video->state = "Pending" ;
          $video->AddedBy = Auth::user()->name;
          $video->CheckedBy = null;
          $video->expired_date = $request->ExpireDate;
          if($s == 'Pending'){
            $video->save();
            return redirect('/Admin/Pending-Videos')->with('success','State Changed, Move To Pending Folder!');
          }
          else
          {
            $video->rejected_reason = null;
            $video->save();
            return redirect('/Admin/rejected-Videos')->with('success','State Changed, Move To Pending Folder!');
          }
    }

    public function ExpandVideo(Request $request , $id)
    {
      $this->validate($request,[
        'ExpireDate'=>'required|date|after:today',
      ]);

        $video = Video::find($id);
        $video->state = "Pending" ;
        $video->AddedBy = Auth::user()->name;
        $video->CheckedBy = null;
        $video->expired_date = $request->ExpireDate;
        $video->save();
        return redirect('/Admin/approved-Videos')->with('success','Expired Date Was Expanded,Waiting For Editor Validation!');

    }

}
