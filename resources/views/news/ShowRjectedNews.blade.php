@extends('layouts.master')

@section('content')
<div class="content-wrapper ScrollStyle vl table-dark">
<div class="container">
<br>
  @include('inc.Errors')
</div>
<div class="container">
<div class="page-header text-center table-dark" style="border-radius:8px;border:2px solid #85144b;">
  <h3>{{$title}}</h3>
</div>
</div>
<div>
@foreach($tuple as $tuples)
<div class="container">
  <div class="align-items-center p-3 my-3 text-#85144b-50 alert-success rounded shadow-sm" style="border-radius:8px;border:2px solid #fff;">
      <div class="row alert-success">
              <div class="col-md-4">
                <h5 style="padding-left:15px"><span class="dot1"></span> {{$tuples->head}}<h5>
              </div>
              <div class="col-md-4">
                <h5><span class="dot1"></span> {{$tuples->body}}</h5>
              </div>
              <div class="col-md-4">
                <h5><span class="dot1"></span> {{$tuples->tail}}</h5>
            </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-md-4" style="border-right:2px solid white;">
          <br>
          <p> Added By {{$tuples->AddedBy}} At {{$tuples->created_at}}</p>
        </div>
        <div class="col-md-4" style="border-right:2px solid white;">
          <br>
          <p> Rejected By {{$tuples->CheckedBy}} At {{$tuples->updated_at}}</p>
      </div>
      <div class="col-md-4">
      <small> {{$tuples->rejected_reason}}</small>
        <hr>
        <div class="row" id="buttons{{$tuples->id}}">
          <div class="col-md-3">
          </div>
          <div class="col-md-4">
            <small><button class="btn-sm editnews btn-info" data-id="{{$tuples->id}}" type="button"><i class="fa fa-edit"></i> Edit</button></small>
          </div>
          <div class="col-md-5">
            <a href="#" data-id="{{$tuples->id}}" class="sa-remove"><small><button class="btn-sm removeSlid btn-info wave-effect btn-bordred wave-light" type="button"><i class="fa fa-times"></i> Delete</button></a></small>
        </div>
    </div>
  </div>
</div>
<br>
<div class="container" style="border-top:2px solid #fff;display:none" id="{{$tuples->id}}"><br>
  <form method="POST" action="/edit/news/{{$tuples->id}}" accept-charset="UTF-8" id="formcontrol" enctype="multipart/form-data">
    @csrf
    <div class="form-row">
      <div class="form-group col-md-2">
      </div>
      <div class="form-group col-md-8">
        <input class="form-control" placeholder="add head" name="nhead" type="text" value="" id="nhead" required>
      </div>
      <div class="form-group col-md-2">
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-2">
      </div>
      <div class="form-group col-md-8">
        <input class="form-control" placeholder="add body" name="nbody" type="text" value="" id="nbody" required>
      </div>
      <div class="form-group col-md-2">
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-2">
      </div>
      <div class="form-group col-md-8">
        <input class="form-control" placeholder="add tail" name="ntail" type="text" value="" id="ntail" required>
      </div>
      <div class="form-group col-md-2">
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-5">
      </div>
      <div class="form-group col-md-1">
        <button type="submit" class="btn-sm btn-lg send-data btn-block btn-info"><i class="fa fa-save"></i> Save</button>
      </div>
      <div class="form-group col-md-1">
        <button  type="button" class="btn-sm btn-lg btn-block btn-info" onClick="history.go(0)"><i class="fa fa-arrow-circle-left"></i></button>
      </div>
    </div>
  </form>
</div>
</div>
</div>
@endforeach

</div>
<script type="text/javascript">
$('.sa-remove').click(function () {
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
               window.location.href = "/delete/news/" + postId;
           });
});
</script>
<script type="text/javascript">
$(document).ready(function(){
  $(".editnews").click(function(e){
    var postId = $(this).data('id');
    e.preventDefault();
    swal("This becomes a pending");
    $("#"+postId).fadeIn(2000);
    $("#buttons"+postId).fadeOut(2000);
  });
});
</script>
@endsection
