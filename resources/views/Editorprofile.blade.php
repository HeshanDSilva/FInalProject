@extends('layouts.Editmaster')

@section('content')
<script type="text/javascript">
$(document).ready(function(){
    $("#recentActivities").hide().fadeIn(3000);
});
</script>
<?php $today=\Carbon\Carbon::now(); ?>
<?php $lastThree=\Carbon\Carbon::now()->subDays(3); ?>
<?php $name=$profile->name;
      $x=0;
?>

<div class="content-wrapper vl table-dark">
  <br>
  <div class="container">
    @include('inc.Errors')
  </div>
  <div class="row" >
    <div class="container col-md-8 ScrollStyle1">
      <div class="container">
        <br><br><br>
           <div class="row justify-content-center">
               <div class="profile-header-container">
                   <div class="profile-header-img">
                       <img id="blah" class="rounded-circle" src="/images/{{ $profile->avatar }}" style="width:250px; height:250px; float:left; border-radius:50%; margin-right:25px;" />
                   </div>
               </div>
             </div>
             <br>
             <div class="row justify-content-center">
                 <h3>Hello! {{$profile->name}} you can change your avatar here</h3>
               </div>
           <br>
           <div class="row justify-content-center">
               <form action="/Dashboard/updateAvatar" method="post" enctype="multipart/form-data">
               @csrf
               <div class="row">
                 <div class="col-md-6">
                   <div class="form-group">
                       <input type="file" class="form-control-file" onchange="readURL(this)" name="avatar" id="avatarFile" aria-describedby="fileHelp">
                   </div>
                 </div>
                <div class="col-md-6">
                   <div class="form-group">
                     <button type="submit" class="btn btn-primary">Change</button>
                   </div>
                </div>
                </div>

                   <small id="fileHelp" class="form-text text-muted">Please upload a valid image file. Size of image should not be more than 2MB.</small>
               </form>
           </div>
       </div>
       <div class="row justify-content-center">
           <h5>Change your Password</h5>
       </div>
       <br>


       <div class="row justify-content-center">
          <form method="post" action="/reset/password" accept-charset="UTF-8" id="formcontrol" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                    <label for="inputEmail4">Password :-</label>
                    <input class="form-control" placeholder="old password" name="password" type="password" value="" id="password" required>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                    <label for="inputEmail4">New Password :-</label>
                    <input type="password" class="form-control sm" id="name" name="new_password" placeholder="new password" required>
                </div>
              </div>
              <div class="col-md-4">
                    <div class="form-group">
                      <br>
                      <button type="submit" class="btn btn-lg send-data btn-block btn-primary">Reset</button>
                    </div>
              </div>
            </div>
            <br>
          </form>
       </div>
    </div>
    <div class="container col-md-4 ScrollStyle1" id="recentActivities">
      <div class="page-header text-center" style="margin-bottom:0px">
          <p>Recent Activities</p>
      </div>
      <!--Sliders-->
      @foreach($slider as $sliders)
          @if( $sliders->CheckedBy == $name and $sliders->created_at <= $today and $sliders->created_at >= $lastThree)
                  <div class="container" style="margin-bottom:10px">
                        <div class="container">
                            <p style="margin-bottom:0px">{{ $sliders->created_at}}</p>
                            @if ($sliders->state == "Accepted")
                                <p style="margin-bottom:0px">{{$sliders->CheckedBy}} You have Accepted <a href="/{{$sliders->image_path}}" target="_blank">{{$sliders->image_path}}</a> which is expired at {{$sliders->expired_date}}.</p>
                                <div class="container" style="border-bottom:1px solid black;">
                                      <small><a href="/Editor/Accepted">More Info</a></small>
                                </div>
                            @elseif($sliders->state == "Rejected")
                              <p style="margin-bottom:0px">{{$sliders->CheckedBy}} You have Rejected <a href="/{{$sliders->image_path}}" target="_blank">{{$sliders->image_path}}</a> which is expired at {{$sliders->expired_date}}.</p>
                              <div class="container pull-right" style="border-bottom:1px solid black;">
                                    <small>Rejected Reason Was {{$sliders->rejected_reason}} <a href="/Editor/Rejected">More Info</a></small>
                              </div>
                            @endif

                        </div>
                  </div>
          @endif
      @endforeach
      <!--Video-->
      @foreach($video as $videos)
          @if( $videos->CheckedBy == $name and $videos->created_at <= $today and $videos->created_at >= $lastThree)
              <div class="container" style="margin-bottom:10px">
                <div class="container">
                    <p style="margin-bottom:0px">{{ $videos->created_at}}</p>
                    @if ($videos->state == "Accepted")
                        <p style="margin-bottom:0px">{{$videos->CheckedBy}} You have Accepted <span style="color:lightgreen">{{$videos->title}}</span> which is expired at {{$videos->expired_date}}.</p>
                        <div class="container" style="border-bottom:1px solid black;">
                              <small><a href="/Editor/approved-Videos">More Info</a></small>
                        </div>
                    @elseif($videos->state == "Rejected")
                      <p style="margin-bottom:0px">{{$videos->CheckedBy}} You have Rejected <span style="color:lightgreen">{{$videos->title}}</span> which is expired at {{$videos->expired_date}}.</p>
                      <div class="container pull-right" style="border-bottom:1px solid black;">
                            <small>Rejected Reason Was {{$videos->rejected_reason}} <a href="/Editor/rejected-Videos">More Info</a></small>
                      </div>
                    @endif
                </div>
              </div>
              @endif
          @endforeach
      <!--News-->
      @foreach($news as $newss)
          @if( $newss->CheckedBy == $name and $newss->created_at <= $today and $newss->created_at >= $lastThree)
            <div class="container" style="margin-bottom:10px">
                <div class="container">
                    @if ($newss->state == "Rejected")
                        <p style="margin-bottom:0px">{{$newss->created_at}}</p>
                        <p style="margin-bottom:0px">{{$newss->CheckedBy}} You have Rejected <span style="color:lightgreen">{{$newss->head}} {{$newss->body}} {{$newss->title}}</span>.</p>
                        <div class="container" style="border-bottom:1px solid black;">
                              <small>Rejected Reason Was {{$newss->rejected_reason}} <a href="/rejected/news/2">More Info</a></small>
                        </div>
                    @endif
                </div>

                </div>
        @endif
    @endforeach
    </div>
</div>
</div>
<script type="text/javascript">
function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah')
                    .attr('src', e.target.result)
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
