@extends('layouts.master')

@section('content')
<div class="content-wrapper ScrollStyle vl table-dark">
<br>
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
    <div class="col-md-4">
      <h5 align="center">{{$shows->image_path}}</h5>
        <a target="_blank" href="/{{$shows->image_path}}" >
          <img src="/{{$shows->image_path}}" id="image" alt="Uploaded image" width="300" height="200" >
        </a>
    </div>
    <div class="col-md-6 " style="border-right:2px solid #fff;"><hr>
      <p align="center">Added by {{$shows->AddedBy}} At {{$shows->created_at}}</p><hr>
      <p align="center">Checked by {{$shows->CheckedBy}} At {{$shows->updated_at}}</p><hr>
      <p align="center">Expired On {{$shows->expired_date}}</p><hr>
      <p align="center">Belongs To {{$shows->category}} Category</p><hr>
      <p align="center">Will Appear On The Screen {{$shows->Transition_time}} Seconds</p><hr>
      <div class="container" style="display:none" id="{{$shows->id}}"><br>
        <form method="POST" action="/expand/slide/{{$shows->id}}" accept-charset="UTF-8" id="formcontrol" enctype="multipart/form-data">
          @csrf
          <div class="form-row">
            <div class="form-group col-md-12">
              <input class="form-control" name="ExpireDate" type="date" value="2018-11-26" required>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
            </div>
            <div class="form-group col-md-2">
              <button type="submit" class="btn-sm btn-lg send-data btn-block btn-info"><i class="fa fa-save"></i> Save</button>
            </div>
            <div class="form-group col-md-2">
              <button type="button" class="btn-sm btn-lg btn-block btn-info" onClick="history.go(0)"><i class="fa fa-arrow-circle-left"></i></button>
            </div>
          </div>
        </form>
      </div>
  </div>
  <div class="col-md-2 ">
    <div class="container"><br>
      <strong align="center"><span style="color:black;">Brodcasting</span></strong><br>
      <h5><span style="color:black;">Started At :-</span></h5>
      <h5><span style="color:black;">{{$shows->updated_at}}</span></h5><hr>
    </div>
    <div class="container instruct{{$shows->id}}" align="center" style="display:none"><br><br><br>
      <strong align="center"><span style="color:black;" >You Can Extend The Expired Date of This Video</span></strong>
    </div>
    <br>
    <div class="row">
      <div class="col-md-6 buttons{{$shows->id}}" style="border-right:2px solid #fff;">
          <button class="btn-sm ExpandSlid btn-info wave-effect btn-bordred wave-light" data-id="{{$shows->id}}" type="button" id="remove"><i class="fa fa-arrows-alt"></i> Expand</button>
      </div>
      <div class="col-md-6 buttons{{$shows->id}}">
          <a href="#" class="slides-remove" data-id="{{$shows->id}}"><button class="btn-sm btn-info wave-effect btn-bordred wave-light" type="button"><i class="fa fa-remove"></i> Delete</button></a>
      </div>
    </div>
  </div>
  </div>
  </div>
  </div>
@endforeach
</div>
<script type="text/javascript">
$('.slides-remove').click(function () {
           var postId = $(this).data('id');
           swal({
               title: "are u sure?",
               text: "This will be permanently deleted",
               type: "error",
               showCancelButton: true,
               confirmButtonClass: 'btn-danger waves-effect waves-light',
               confirmButtonText: "Delete",
               cancelButtonText: "Cancel",
               closeOnConfirm: true,
               closeOnCancel: true
           },
           function(){
               window.location.href = "/delete/slide/" + postId;
           });
});
</script>

<script type="text/javascript">
$(document).ready(function(){
  $(".ExpandSlid").click(function(e){
    var postId = $(this).data('id');
    e.preventDefault();
    $(".buttons"+postId).hide();
    $(".instruct"+postId).fadeIn(2000);
    $("#"+postId).fadeIn(2000);
  });
});

</script>
@endsection
