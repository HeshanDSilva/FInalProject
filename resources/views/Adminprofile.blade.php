@extends('layouts.master')

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
        <br><br>
           <div class="row justify-content-center">
               <div class="profile-header-container">
                   <div class="profile-header-img">
                       <img id="blah" class="rounded-circle" src="/images/{{ $profile->avatar }}" style="width:250px; height:250px; float:left; border-radius:50%; margin-right:25px;" />
                   </div>
               </div>
             </div>
             <br>
             <div class="row justify-content-center">
                 <h5>Hello! {{$profile->name}} you can change your avatar here</h5>
             </div>
             <br>
           <div class="row justify-content-center">
               <form action="/Dashboard/updateAvatar" method="post" enctype="multipart/form-data">
               @csrf
               <div class="row justify-content-center">
                 <div class="col-md-6">
                   <div class="form-group">
                       <input type="file" class="form-control-file" name="avatar" id="avatarFile" onchange="readURL(this)" aria-describedby="fileHelp">
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
           <br>
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
          @if( $sliders->AddedBy == $name and $sliders->created_at <= $today and $sliders->created_at >= $lastThree)
              <?php $x++; ?>
                  <div class="container" style="margin-bottom:10px">
                        <div class="container">
                            <p style="margin-bottom:0px">{{ $sliders->created_at}}</p>
                              <p style="margin-bottom:0px">{{$sliders->AddedBy}} You have added <a href="/{{$sliders->image_path}}" target="_blank">{{$sliders->image_path}}</a> which is expired at {{$sliders->expired_date}} and is {{$sliders->state}}</p>
                                <div class="container pull-right" style="border-bottom:1px solid black;">
                                @if ($sliders->state == "Pending")
                                      <small><a href="/Pending">More Info</a></small>
                                  @elseif( $sliders->state == "Accepted")
                                      <small><a href="/Approved">More Info</a></small>
                                  @elseif ($sliders->state == "Rejected")
                                      <small><a href="/Rejected">More Info</a></small>
                                  @endif
                              </div>
                        </div>
                  </div>
          @endif
      @endforeach
      <!--Video-->
      @foreach($video as $videos)
          @if( $videos->AddedBy == $name and $videos->created_at <= $today and $videos->created_at >= $lastThree)
              <div class="container" style="margin-bottom:10px">
                  <div class="container">
                      <p style="margin-bottom:0px">{{$videos->created_at}}</p>
                      <p style="margin-bottom:0px"> {{$videos->AddedBy}} You have added <span style="color:lightgreen">{{$videos->title}}</span> which is expired at {{$videos->expired_date}} and is {{$videos->state}}</p>
                      <div class="container pull-right" style="border-bottom:1px solid black;">
                      @if ($videos->state == "Pending")
                            <small><a href="/Admin/Pending-Videos">More Info</a></small>
                        @elseif( $videos->state == "Accepted")
                            <small><a href="/Admin/approved-Videos">More Info</a></small>
                        @elseif ($videos->state == "Rejected")
                            <small><a href="/Admin/rejected-Videos">More Info</a></small>
                        @endif
                    </div>

                  </div>
              </div>
              @endif
          @endforeach
      <!--News-->
      @foreach($news as $newss)
          @if( $newss->AddedBy == $name and $newss->created_at <= $today and $newss->created_at >= $lastThree)
            <div class="container" style="margin-bottom:10px">
                <div class="container">
                    <p style="margin-bottom:0px">{{$newss->created_at}}</p>
                    <p style="margin-bottom:0px">{{$newss->AddedBy}} You have added <span style="color:lightgreen">"{{$newss->head}} {{$newss->body}} {{$newss->tail}}"</span>.</p>
                    <div class="container pull-right" style="border-bottom:1px solid black;">
                    @if ($videos->state == "Played")
                          <small><a href="/Played/news/1">More Info</a></small>
                      @elseif( $videos->state == "Rejected")
                          <small><a href="/rejected/news/1">More Info</a></small>
                      @else
                          <small><a href="/Upload/news">More Info</a></small>
                      @endif
                  </div>

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
