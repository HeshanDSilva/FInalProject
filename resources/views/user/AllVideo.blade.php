@extends('layouts.master')

@section('content')
<div class="content-wrapper ScrollStyle vl table-dark"><br>
<section class="content-header">
  <div class="page-header text-center table-dark" style="border:1px solid white;">
    <h3>Detailed Videos</h3>
  </div>
  <div class="container">
      @include('inc.Errors')
  </div>
  <div class="container">
  {!! Form::open(["url" => "/filter/videos","files" => true,"id" => "formcontrol","enctype"=>"multipart/form-data"]) !!}
<div class="row">
  <div class="col-md-1">
    <div class="form-group">
    </div>
  </div>
  <div class="col-md-2">
    <div class="form-group">
      <a href="/video/upload/form" class="btn btn btn-lg btn-outline-success"><i class="fa fa-plus"></i></a>
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
        <th scope="col" style="text-align:center">VideoId</th>
        <th scope="col" style="text-align:center">Youtube_Id</th>
        <th scope="col" style="text-align:center">ex_date</th>
        <th scope="col" style="text-align:center">Category</th>
        <th scope="col" style="text-align:center">Added_By</th>
        <th scope="col" style="text-align:center">Checked_By</th>
        <th scope="col" style="text-align:center">Created_At</th>
        <th scope="col" style="text-align:center">State</th>
      </tr>
    </thead>
    <tbody>
      @foreach($video as $videos)
          <tr>
            <th scope="row" style="text-align:center">{{$videos->id}}</th>
            <th scope="row" style="text-align:center">{{$videos->video_id}}</th>
            <td style="text-align:center">{{$videos->expired_date}}</td>
            <td style="text-align:center">@if ($videos->category == 'Distributor')
                  <button style="background-color:#0000FF;border:none;">{{$videos->category}}</button>
               @elseif($videos->category == 'Dealer')
                  <button style="background-color:red;border:none;">{{$videos->category}}</button>
              @elseif($videos->category == 'Retail')
                  <button style="background-color:yellow;border:none;">{{$videos->category}}</button>
              @else
                  <button style="background-color:green;border:none;">{{$videos->category}}</button>
              @endif
            </td>
            <td style="text-align:center">{{$videos->AddedBy}}</td>
              @if($videos->state == 'Pending')
                <td style="background-color:#0000FF;border:none;text-align:center" >Pending</td>
              @else
                <td style="text-align:center">{{$videos->CheckedBy}}</td>
              @endif
            <td style="text-align:center">{{$videos->created_at}}</td>
            <td style="text-align:center">{{$videos->state}}</td>
          </tr>
      @endforeach
    </tbody>
    </table>
  </div>
</section>

@endsection
