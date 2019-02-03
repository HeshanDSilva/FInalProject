@extends('layouts.master')

@section('content')
<div class="content-wrapper ScrollStyle vl table-dark">
<div class="container">
<br>
  @include('inc.Errors')
</div>
<div class="container">
<div class="page-header text-center table-dark" style="border-radius:8px;border:2px solid #85144b;">
  <h3>Add New News Here</h3>
</div>
</div>
<div>
<form method="POST" action="/newsChange" accept-charset="UTF-8" id="formcontrol" enctype="multipart/form-data">
@csrf
<table class="table table-hover alert-success">
<tbody>
<tr>
  <td><h4><i class="fa fa-circle-o"> {{$title1}}</h4></td>
</tr>
</tbody>
</table>
<div class="form-row">
  <div class="form-group col-md-4">
    <h5 style="padding-left:15px"><span class="dot"></span> {{$pendinghead1}}</h5>
  </div>
  <div class="form-group col-md-4">
    <h5><span class="dot"></span> {{$pendingbody1}}</h5>
  </div>
  <div class="form-group col-md-4">
    <h5><span class="dot"></span> {{$pendingtail1}}</h5>
</div>
</div>
<table class="table table-hover alert-success">
<tbody>
<tr>
  <td><h4><i class="fa fa-circle-o"> {{$title}}</h4></td>
</tr>
</tbody>
</table>

@if($n == 0)
    <div class="form-row">
      <div class="form-group ">
        <h5 style="padding-left:15px;text-align:center"> <span class="dot"></span> System Has No Pending News</h5>
      </div>
    </div>
@endif
@foreach($pendings as $pending)
<div class="container">
  <div class="align-items-center p-3 my-3 text-#85144b-50 table-dark rounded shadow-sm" style="border-radius:8px;border:2px solid #fff;">
      <div class="row alert-dark">
              <div class="col-md-4">
                <h5 style="padding-left:15px"><span class="dot1"></span> {{$pending->head}}<h5>
              </div>
              <div class="col-md-4">
                <h5><span class="dot1"></span> {{$pending->body}}</h5>
              </div>
              <div class="col-md-4">
                <h5><span class="dot1"></span> {{$pending->tail}}</h5>
            </div>
      </div>
      <div class="row">
        <div class="col-md-6" style="border-right:2px solid white;">
          <br>
          <p> Added By {{$pending->AddedBy}} At {{$pending->created_at}}</p>
        </div>
      <div class="col-md-6" id="buttons{{$pending->id}}"><hr>
        <div class="row">
          <div class="col-md-3">
          </div>
          <div class="col-md-4">
            <small><a href="#" data-id="{{$pending->id}}" class="editnews"><button class="btn-sm removeSlid btn-primary" type="button"><i class="fa fa-edit"></i> Edit</button></a></small>
          </div>
          <div class="col-md-5">
            <small><a href="#" data-id="{{$pending->id}}" class="news-remove"><button class="btn-sm removeSlid btn-danger" type="button"><i class="fa fa-times"></i> Delete</button></a></small>
          </div>
        </div>
    </div>
  </div>
  <div class="container" style="border-top:2px solid #fff;display:none" id="{{$pending->id}}"><br>
    <form method="POST" action="/edit/news/{{$pending->id}}" accept-charset="UTF-8" id="formcontrol" enctype="multipart/form-data">
      @csrf
      <div class="form-row">
        <div class="form-group col-md-4">
          <input class="form-control" placeholder="{{$pending->head}}" name="nhead" type="text" value="" id="nhead" required>
        </div>
        <div class="form-group col-md-4">
            <input class="form-control" placeholder="{{$pending->body}}" name="nbody" type="text" value="" id="nbody" required>
        </div>
        <div class="form-group col-md-4">
            <input class="form-control" placeholder="{{$pending->tail}}" name="ntail" type="text" value="" id="ntail" required>
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


<table class="table table-hover alert-success">
<tbody>
<tr>
<td><h4><i class="fa fa-circle-o"> Change The News</h4></td>
</tr>
</tbody>
</table>
<div class="container-fluid table-dark" >
<hr>
<div class="form-row">
    <div class="form-group col-md-5" >
      <h5><span class="dot"></span> {{$pendinghead1}}</h5>
    </div>
    <div class="form-group col-md-5">
      <input class="form-control" placeholder="{{$pendinghead1}}" name="head" type="text" value="" id="head" disabled="true">
    </div>
    <div class="form-group col-md-2">
        <button class="btn edit-head btn-outline-primary" id="b1" type="button">Change</button>
    </div>
  </div>
  <hr>
  <div class="form-row">
    <div class="form-group col-md-5">
      <h5><span class="dot"></span> {{$pendingbody1}}</h5>
    </div>
    <div class="form-group col-md-5">
      <input class="form-control" placeholder="{{$pendingbody1}}" name="body" type="text" value="" id="body" disabled="true">
    </div>
    <div class="form-group col-md-2">
        <button class="btn edit-body btn-outline-primary" id="b2" type="button">Change</button>
    </div>
  </div>
  <hr>
  <div class="form-row">
    <div class="form-group col-md-5">
      <h5><span class="dot"></span> {{$pendingtail1}}</h5>
    </div>
    <div class="form-group col-md-5">
      <input class="form-control" placeholder="{{$pendingtail1}}" name="tail" type="text" value="" id="tail" disabled="true">
    </div>
    <div class="form-group col-md-2">
        <button class="btn edit-tail btn-outline-primary" id="b3" type="button">Change</button>
    </div>
  </div>
  <hr>
  <div class="form-row">
    <div class="form-group col-md-4">
    </div>
    <div class="form-group col-md-4">
      <button type="submit" class="btn btn-lg send-data btn-block btn-outline-primary" id="b4" disabled="true">Add News</button>
    </div>
    <div class="form-group col-md-4">
    </div>
  </div>
</div>
</form>

</div>
</div>
<script type="text/javascript">
$('.news-remove').click(function () {
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
    swal("Edit Content");
    $("#"+postId).fadeIn(2000);
    $("#buttons"+postId).fadeOut(2000);
  });
});
</script>


<script type="text/javascript">
$(document).ready(function(){
  $(".edit-head").click(function(e){
  e.preventDefault();
  $( "#head" ).prop( "disabled", false );
  $( "#b4" ).prop( "disabled", false );
  });
  $(".edit-body").click(function(e){
  e.preventDefault();
  $( "#body" ).prop( "disabled", false );
  $( "#b4" ).prop( "disabled", false );
  });
  $(".edit-tail").click(function(e){
  e.preventDefault();
  $( "#tail" ).prop( "disabled", false );
  $( "#b4" ).prop( "disabled", false );
  });
});
</script>

@endsection
