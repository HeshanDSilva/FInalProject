@extends('layouts.Editmaster')

@section('content')
<div class="content-wrapper ScrollStyle vl table-dark">
<div class="container">
<br>
  @include('inc.Errors')
</div>
<div class="container">
<div class="page-header text-center table-dark" style="border-radius:8px;border:2px solid #85144b;">
  <h3>News Management Page</h3>
</div>
</div>
<div>
<br>
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
            <small><a href="#" data-id="{{$pending->id}}" class="editnews"><a href="/accept/news/{{$pending->id}}" class="btn btn-outline-primary" id="accept"><i class="fa fa-thumbs-o-up"></i> Accept</a></a></small>
          </div>
          <div class="col-md-5">
            <small><a href="#" data-id="{{$pending->id}}" class="rejectNews"><button class="btn rejectNews btn-outline-primary" type="button" id="Rnews"><i class="fa fa-remove"></i> Reject </button></a></small>
          </div>
        </div>
    </div>
  </div>
  <div id="{{$pending->id}}" style="display:none;">
    <br>
    <form method="POST" action="/Editor/news/Reject/{{$pending->id}}" accept-charset="UTF-8" id="formcontrol" enctype="multipart/form-data">
      @csrf
      <div class="form-group">
        <input class="form-control" name="RemoveSlide" type="text" placeholder="Place here the reason to reject">
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
</div>
@endforeach
</div>
</div>

<script type="text/javascript">
$(document).ready(function(){
  $(".rejectNews").click(function(e){
    var postId = $(this).data('id');
    e.preventDefault();
    swal("Provide A Reason");
    $("#"+postId).fadeIn(2000);
    $("#buttons"+postId).fadeOut(2000);
  });
});
</script>

@endsection
