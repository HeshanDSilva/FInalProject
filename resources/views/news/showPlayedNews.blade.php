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
          <p> Rejected By {{$tuples->CheckedBy}} At {{$tuples->updated_at}} </p>
      </div>
      <div class="col-md-4">
        <small> Last Day Of Brodcasting Was {{$tuples->updated_at}}</small>
        <hr>
        <div class="row">
          <div class="col-md-3">
          </div>
          <div class="col-md-4">
            <small><a href="#" data-id="{{$tuples->id}}" class="news-replay"><button class="btn-sm removeSlid btn-danger" id="remove" type="button"><i class="fa fa-repeat"></i> Replay</button></a></small>
          </div>
          <div class="col-md-5">
            <small><a href="#" data-id="{{$tuples->id}}" class="news-remove"><button class="btn-sm removeSlid btn-danger" id="remove" type="button"><i class="fa fa-times"></i> Delete</button></a></small>
          </div>
        </div>
    </div>
      </div>
  </div>
</div>
@endforeach
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

$('.news-replay').click(function () {
           var postId = $(this).data('id');
           swal({
               title: "are u sure?",
               text: "This will be the new pending",
               type: "warning",
               showCancelButton: true,
               confirmButtonClass: 'btn-danger waves-effect waves-light',
               confirmButtonText: "Replay",
               cancelButtonText: "Cancel",
               closeOnConfirm: true,
               closeOnCancel: true
           },
           function(){
               window.location.href = "/replay/news/" + postId;
           });
});
</script>

@endsection
