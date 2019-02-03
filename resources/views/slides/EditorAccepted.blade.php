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
    <div class="col-md-8 "><hr>
      <p align="center">Added by {{$shows->AddedBy}} At {{$shows->created_at}}</p><hr>
      <p align="center">Checked by {{$shows->CheckedBy}} At {{$shows->updated_at}}</p><hr>
      <p align="center">Expired On {{$shows->expired_date}}</p><hr>
      <p align="center">Belongs To {{$shows->category}} Category</p><hr>
      <p align="center">Will Appear On The Screen {{$shows->Transition_time}} Seconds</p>
    </div>
  </div>
  </div>
  </div>
@endforeach
</div>
@endsection
