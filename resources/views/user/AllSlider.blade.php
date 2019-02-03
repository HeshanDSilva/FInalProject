@extends('layouts.master')

@section('content')
<div class="content-wrapper ScrollStyle vl table-dark"><br>
<section class="content-header">
  <div class="page-header text-center table-dark" style="border:1px solid white;">
    <h3>Detailed Sliders</h3>
  </div>
  <div class="container">
      @include('inc.Errors')
  </div>
  <div class="container">
  {!! Form::open(["url" => "/filter/sliders","files" => true,"id" => "formcontrol","enctype"=>"multipart/form-data"]) !!}
<div class="row">
  <div class="col-md-1">
    <div class="form-group">
    </div>
  </div>
  <div class="col-md-2">
    <div class="form-group">
      <a href="/Upload" class="btn btn btn-lg btn-outline-success"><i class="fa fa-plus"></i></a>
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
        <th scope="col" style="text-align:center">ImageId</th>
        <th scope="col" style="text-align:center">exd_at</th>
        <th scope="col" style="text-align:center">Category</th>
        <th scope="col" style="text-align:center">Added_By</th>
        <th scope="col" style="text-align:center">Checked_By</th>
        <th scope="col" style="text-align:center">Created_At</th>
        <th scope="col" style="text-align:center">State</th>
      </tr>
    </thead>
    <tbody>
      @foreach($image as $images)
          <tr>
            <th scope="row" style="text-align:center">{{$images->id}}</th>
            <td style="text-align:center">{{$images->expired_date}}</td>
            <td style="text-align:center">@if ($images->category == 'Distributor')
                  <button style="background-color:#0000FF;border:none;">{{$images->category}}</button>
               @elseif($images->category == 'Dealer')
                  <button style="background-color:red;border:none;">{{$images->category}}</button>
              @elseif($images->category == 'Retail')
                  <button style="background-color:yellow;border:none;">{{$images->category}}</button>
              @else
                  <button style="background-color:green;border:none;">{{$images->category}}</button>
              @endif
            </td>
            <td style="text-align:center">{{$images->AddedBy}}</td>
              @if($images->state == 'Pending')
                <td style="background-color:#0000FF;border:none;text-align:center" >Pending</td>
              @else
                <td style="text-align:center">{{$images->CheckedBy}}</td>
              @endif
            <td style="text-align:center">{{$images->created_at}}</td>
            <td style="text-align:center">{{$images->state}}</td>
          </tr>
      @endforeach
    </tbody>
    </table>
  </div>
</section>

@endsection
