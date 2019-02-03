@extends('layouts.Editmaster')

@section('content')
<div class="content-wrapper ScrollStyle vl table-dark">
<br>
<div class="container">
    @include('inc.Errors')
</div>
<div class="page-header text-center table-dark" style="border:1px solid white;">
  <h3>{{$title}}</h3>
</div>
@foreach($video as $videos)
<div class="container">
  <div class="align-items-center p-3 my-3 text-#85144b-50 alert-success rounded shadow-sm" style="border-radius:10px;border:1px solid white;">
  <div class="row">
    <div class="col-md-4" style="border-right:2px solid #fff;">
      <h5 align="center">{{$videos->title}}</h5>
      <iframe width="300" height="200" src="https://www.youtube.com/embed/{{$videos->video_id}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>
    <div class="col-md-6 " style="border-right:2px solid #fff;"><hr>
      <p align="center">Added by {{$videos->AddedBy}} At {{$videos->created_at}}</p><hr>
      <p align="center">Checked by {{$videos->CheckedBy}} At {{$videos->updated_at}}</p><hr>
      <p align="center">Expired On {{$videos->expired_date}}</p><hr>
      <p align="center">Belongs To {{$videos->category}} Category</p><hr>
      <p align="center">ID on Youtube Is {{$videos->video_id}}</p>
    </div>
    <div class="col-md-2">
      <div class="container"><br><br>
          <strong align="center"><span style="color:black;">Rejected Reason</span></strong><hr>
          <p align="center"><span style="color:black;">{{$videos->rejected_reason}}</span><p>
      </div>
    </div>
  </div>
  </div>
</div>
@endforeach
</div>
@endsection
