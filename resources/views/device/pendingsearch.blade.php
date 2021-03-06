@extends('layouts.master')

@section('content')
<div class="content-wrapper ScrollStyle vl table-dark">
  <!-- Content Header (Page header) -->
  <section class="content-header">
   <br> <h1>
   Search Device
    </h1>

  </section>

  <!-- Main content -->
  <section class="content">

  <div id="content">

<div id="content-header">


</div>
<div class="container-fluid">
  <hr>
  <div class="row-fluid">
    <div class="span6">

     @if(isset($details))
        <h6> The Search results for your query <b> {{ $query }} </b> are :</h6>
   <br>
    <table class="table table-striped">
        <thead>
            <tr>
                <th style="text-align:center">ID</th>
                <th style="text-align:center">Location</th>
                <th style="text-align:center">Category</th>
                <th colspan="2" style="text-align:center">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($details as $device)
            <tr>
            @if($device['state'] =='Pending')
        <td style="text-align:center">{{$device->id}}</td>
        <td style="text-align:center">{{$device->location}}</td>
        <td style="text-align:center">{{$device->category}}</td>
        @if(Auth::user()->type =='admin')
        <td style="text-align:center"><a href="{{action('pendingController@edit', $device->id)}}" class="btn btn-outline-success">Accept</a>
        <a href="{{action('pendingController@show', $device->id)}}" class="btn btn-outline-danger">Reject</a></td>
        @endif
      </tr>
            @endif
            @endforeach
        </tbody>
    </table>
    @endif
</div>







      </div>



  </section>

@endsection
