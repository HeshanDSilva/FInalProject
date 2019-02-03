<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Slider;
use App\Category;
use Illuminate\Http\Request;
use Mail;
use App\Mail\SendEmail;
use App\User;
class slideController extends Controller
{
  public function showuploadForm(){
    $category = Category::all();
     return view('slides.SliderUpload',compact('category'));
  }
  public function StoresFile(request $request){
    $n=0;
    $this->validate($request,[
      'Category'=>'required',
      'ExpireDate'=>'required|date|after:today',
      'image'=>'required',
      'TransitionTime'=>'required|numeric|min:30|max:200',
      'Screen'=>'required'
    ]);
    
    if($request->hasFile('image')){
        $TT = $request->TransitionTime;
        $ED = $request->ExpireDate;
        $C = $request->Category;
        $SN = $request->Screen;

      foreach ($request->image as $file){
        $filename = $file->getClientOriginalName();
        $file->move(public_path(). '/',$filename);
        $sliders = new Slider;
        $sliders->image_path = $filename;
        $sliders->Transition_time = $TT;
        $sliders->screen = $SN;
        $sliders->expired_date = $ED;
        $sliders->state = "Pending" ;
        $sliders->category = $C;
        $sliders->AddedBy = Auth::user()->name;
        $sliders->save();
        $n++;
      }
    }
//Sending Email
    $users = User::where('type','=','editor')->get();
    foreach ($users as $user) {
      $email = $user->email;
      $subject = 'New Pending Sliders Availible';
      $massage = Auth::user()->name.' is added new '.$n.' slider to the system. visit and check the new sliders';
      Mail::to($email)->send( new SendEmail($subject, $massage) );
    }
    return redirect('/Upload')->with('success','Images Uploaded');
}

      public function EditSlider(request $request , $id)
      {
        $this->validate($request,[
          'Category'=>'required',
          'ExpireDate'=>'required|date|after:today',
          'TransitionTime'=>'required|numeric|min:30|max:120',
          'Screen'=>'required'
        ]);

          $slider = Slider::find($id);
          $s = $slider->state;
          $slider->Transition_time = $request->TransitionTime;
          $slider->screen = $request->Screen;
          $slider->category = $request->Category;
          $slider->state = "Pending" ;
          $slider->AddedBy = Auth::user()->name;
          $slider->CheckedBy = null;
          $slider->expired_date = $request->ExpireDate;
          if($s == 'Pending'){
            $slider->save();
            $users = User::where('type','=','editor')->get();
            foreach ($users as $user) {
              $email = $user->email;
              $subject = 'New Pending Sliders Availible';
              $massage = Auth::user()->name.' is edited a slider which was pending. visit and check the new sliders';
              Mail::to($email)->send( new SendEmail($subject, $massage) );
            }
            return redirect('/Pending')->with('success','State Changed, Move To Pending Folder!');
          }
          else
          {
            $slider->rejected_reason = null;
            $slider->save();
            $users = User::where('type','=','editor')->get();
            foreach ($users as $user) {
              $email = $user->email;
              $subject = 'New Pending Sliders Availible';
              $massage = Auth::user()->name.' is edited a slider which was rejected. visit and check the new sliders';
              Mail::to($email)->send( new SendEmail($subject, $massage) );
            }
            return redirect('/Rejected')->with('success','State Changed, Move To Pending Folder!');
          }

      }

      public function RejectSliders(request $request,$id)
      {
        $slider = Slider::find($id);
        $slider->rejected_reason=$request->RemoveSlide;
        $slider->state = 'Rejected';
        $slider->CheckedBy = Auth::user()->name;
        $slider->save();
        return redirect('/Editor/Pending')->with('success','Reason Saved, Move To Reject Folder');

      }

      public function AcceptSliders($id){
      {
          $slider = Slider::find($id);
          $slider->state = 'Accepted';
          $slider->CheckedBy = Auth::user()->name;
          $slider->save();
      }
          return redirect('/Editor/Pending')->with('success','State Changed, Move To Accept Folder');
      }

      public function showApprovedSlides(){
        $show = Slider::where('state', '=', 'Accepted' )->get();
        $n = 0;
        foreach ($show as $shows){
          $n++;
        }
        if($n == 0){
            $data['title'] = "No Approved Sliders Available";
            return view('slides.AdminAccepted',$data,compact('show'));
        }
        $data['title'] = "All Approved Sliders";
        return view('slides.AdminAccepted',$data,compact('show'));
      }

      public function showEditorApprovedSlides(){
        $show = Slider::where('state', '=', 'Accepted' )->get();
        $n = 0;
        foreach ($show as $shows){
          $n++;
        }
        if($n == 0){
            $data['title'] = "No Approved Sliders Available";
            return view('slides.EditorAccepted',$data,compact('show'));
        }
        $data['title'] = "All Approved Sliders";
        return view('slides.EditorAccepted',$data,compact('show'));
      }

      public function showPendingSlides(){

        $show = Slider::where('state', '=', 'Pending' )->get();
        $n = 0;
        foreach ($show as $shows){
          $n++;
        }
        if($n == 0){
          $data['title'] = "No Pending Sliders Available";
          return view('slides.AdminPendings',$data,compact('show'));
        }
        $data['title'] = "All Pending Sliders";
        return view('slides.AdminPendings',$data,compact('show'));
      }

      public function showEditorPendingSlides(){
        $show = Slider::where('state', '=', 'Pending' )->get();
        $n = 0;
        foreach ($show as $shows){
          $n++;
        }
        if($n == 0){
          $data['title'] = "No Pending Sliders Available";
          return view('slides.EditorPendings',$data,compact('show'));
        }
        $data['title'] = "All Pending Sliders";
        return view('slides.EditorPendings',$data,compact('show'));
      }

      public function showRejectedSlides(){

        $show = Slider::where('state', '=', 'Rejected' )->get();
        $n = 0;
        foreach ($show as $shows){
          $n++;
        }
        if($n == 0){
          $data['title'] = "No Rejected Sliders Available";
          return view('slides.AdminRejected',$data,compact('show'));
        }
        $data['title'] = "All Rejected Sliders";
        return view('slides.AdminRejected',$data,compact('show'));
      }

      public function showEditorRejectedSlides(){
        $show = Slider::where('state', '=', 'Rejected' )->get();
        $n = 0;
        foreach ($show as $shows){
          $n++;
        }
        if($n == 0){
          $data['title'] = "No Rejected Sliders Available";
          return view('slides.EditorRejected',$data,compact('show'));
        }
        $data['title'] = "All Rejected Sliders";
        return view('slides.EditorRejected',$data,compact('show'));
      }

      public function DeleteSliders($id)
      {
        $slide = Slider::where('id', $id)->first();
        $s = $slide->state;
        $slide->delete();
        if($s == 'Pending'){
          return redirect('/Pending')->with('success','Slider Was permanently Deleted!');
        }
        else if($s == 'Rejected'){
          return redirect('/Rejected')->with('success','Slider Was permanently Deleted!');
        }
        else if($s == 'Accepted'){
          return redirect('/Approved')->with('success','Slider was permanently Deleted!');
        }
        else {
          ;
        }
      }

      public function ExpandSliders(Request $request , $id)
      {
        $slider = Slider::find($id);
        $slider->expired_date = $request->ExpireDate;
        $slider->AddedBy = Auth::user()->name;
        $slider->CheckedBy = null;
        $slider->state = 'Pending';
        $slider->save();
        $users = User::where('type','=','editor')->get();
        foreach ($users as $user) {
          $email = $user->email;
          $subject = 'New Pending Sliders Availible';
          $massage = Auth::user()->name.' is requested to replay a slide which has already played. visit and check the new sliders';
          Mail::to($email)->send( new SendEmail($subject, $massage) );
        }
        return redirect('/Approved')->with('success','Time Exanded, Waiting for Editor Validation');
      }

}
