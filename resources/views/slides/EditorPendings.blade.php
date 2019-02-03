@extends('layouts.Editmaster')

@section('content')
<div class="content-wrapper ScrollStyle vl table-dark"><br>
<div class="container">
    @include('inc.Errors')
</div>
<div class="page-header text-center table-dark" style="border:1px solid white;">
  <h3>{{$title}}</h3>
</div>
@foreach($show as $shows)
<div class="container">
<div class="align-items-center p-3 my-3 text-#85144b-50 alert-success rounded shadow-sm" style="border-radius:10px;border:1px solid white;">
<div class="row">
  <div class="col-md-4" style="border-right:2px solid #fff;">
    <h5 align="center">{{$shows->image_path}}</h5>
      <a target="_blank" href="/{{$shows->image_path}}" >
        <img src="/{{$shows->image_path}}" id="image" alt="Uploaded image" width="300" height="200" >
      </a>
  </div>
  <div class="col-md-6 " style="border-right:2px solid #fff;"><hr>
    <p align="center">Added by {{$shows->AddedBy}} At {{$shows->created_at}}</p><hr>
    <p align="center">Expired On {{$shows->expired_date}}</p><hr>
    <p align="center">Belongs To {{$shows->category}} Category</p><hr>
    <p align="center">Will Appear On The Screen {{$shows->Transition_time}} Seconds</p><hr>
    <div id="{{$shows->id}}" style="display:none;">
      <br>
      <form method="POST" action="/Editor/Pending/Reject/{{$shows->id}}" accept-charset="UTF-8" id="formcontrol" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <input class="form-control" name="RemoveSlide" type="text" placeholder="Place here the reason to reject" required>
        </div>
        <div class="form-row">
          <div class="form-group col-md-4">
          </div>
          <div class="form-group col-md-2">
            <div class="form-group">
              <input class="btn-sm btn-lg send-data btn-block btn-danger" type="submit" id="reject" value="Reject">
            </div>
          </div>
          <div class="form-group col-md-2">
            <button type="button" class="btn-sm btn-lg btn-block btn-info" onClick="history.go(0)"><i class="fa fa-arrow-circle-left"></i></button>
          </div>
        </form>
    </div>
  </div>
</div>
  <div class="col-md-1 {{$shows->id}}" style="border-right:2px solid #fff;">
    <br><br><br><br><br>
      <button class="btn-sm removeSlid btn-info wave-effect btn-bordred wave-light" data-id="{{$shows->id}}" type="button" id="remove"><i class="fa fa-remove"></i> Reject</button>
  </div>
  <div class="col-md-1 {{$shows->id}}">
    <br><br><br><br><br>
      <a href="/Editor/Pending/Accept/{{$shows->id}}"><button class="btn-sm btn-info wave-effect btn-bordred wave-light" type="button"><i class="fa fa-thumbs-o-up"></i> Accept</button></a>
  </div>
</div>
</div>
</div>
@endforeach
</div>

<script type="text/javascript">
$(document).ready(function(){
  $(".removeSlid").click(function(e){
    var postId = $(this).data('id');
    e.preventDefault();
    $("#" + postId).fadeIn(2000);
    $("." + postId).fadeOut(2000);
  });
});
</script>

@endsection
