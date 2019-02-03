@extends('layouts.master')

@section('content')
<div class="content-wrapper ScrollStyle vl table-dark"><br>
<section class="content-header">
  <div class="page-header text-center table-dark" style="border:1px solid white;">
    <h3>Detailed News</h3>
  </div>
  <div class="container">
      @include('inc.Errors')
  </div>
  <div class="container">
  {!! Form::open(["url" => "/filter/news","files" => true,"id" => "formcontrol","enctype"=>"multipart/form-data"]) !!}
<div class="row">
  <div class="col-md-1">
    <div class="form-group">
    </div>
  </div>
  <div class="col-md-2">
    <div class="form-group">
      <a href="/Upload/news" class="btn btn btn-lg btn-outline-success"><i class="fa fa-plus"></i></a>
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-group">
      {{Form::date("startdate", \Carbon\Carbon::now(),["class" => "form-control"])}}
    </div>
  </div>

  <div class="col-md-3">
    <div class="form-group">
      {{Form::date("enddate", \Carbon\Carbon::now(),["class" => "form-control"])}}
    </div>
  </div>
  <div class="col-md-2">
    <div>
      {{Form::submit('Filter',['class' => 'btn btn-lg send-data btn-block btn-outline-success'])}}
    </div>
  </div>
</div>
{!! Form::close() !!}
</div>
</section>
<section class="content">
  <div class="table-dark" style="margin:0px">
      <table class="table table-dark" border="1px solid white">
        <thead class="alert-success">
        <tr>
          <th scope="col">News_id</th>
          <th scope="col">News</th>
          <th scope="col">State</th>
          <th scope="col">AddedBy</th>
          <th scope="col">CheckedBy</th>
          <th scope="col">Created_At</th>
        </tr>
      </thead>
      <tbody>
        @foreach($news as $newss)
            <tr>
            <th scope="row">{{$newss->id}}</th>
            <td>{{$newss->head}} {{$newss->body}} {{$newss->tail}}</td>
            <td>{{$newss->state}}</td>
            <td>{{$newss->AddedBy}}</td>
            @if($newss->state == 'Pending' || $newss->state == 'Spam')
              <td style="background-color:green">Pending</td>
            @else
              <td>{{$newss->CheckedBy}}</td>
            @endif
            <td>{{$newss->created_at}}</td>
            </tr>
        @endforeach
      </tbody>
    </table>
    </div>
</section>

@endsection
