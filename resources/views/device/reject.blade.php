@extends('layouts.master')

@section('content')
<div class="content-wrapper ScrollStyle vl table-dark">
  <div class="container">
    <br>
    @include('inc.Errors')
  </div>
  <br>
  <div class="alert-success text-white p-3">
  <form action="/rejectsearch" method="POST" role="search">
      {{ csrf_field() }}
      <div class="row">
        <div class="col-md-7">
            <h3>Rejected devices</h3>
        </div>
          <div class="col-md-5">
              <input type="search" id="search" name="search" class="form-control" placeholder="Search & Enter">
          </div>
      </div>

  </form>
  </div>

   <br>
    <table class="table table-striped table-dark">
    <thead>
      <tr class="alert-success">
        <th style="text-align:center">ID</th>
        <th style="text-align:center">User_Id</th>
        <th style="text-align:center">Location</th>
        <th style="text-align:center">Category</th>
        @if(Auth::user()->type =='admin')
        <th style="text-align:center">Action</th>
        @endif
      </tr>
    </thead>
    <tbody>



      @foreach($devices as $device)
      <tr>
        <td style="text-align:center">{{$device->id}}</td>
        <td style="text-align:center">{{$device->user_id}}</td>
        <td style="text-align:center">{{$device->location}}</td>
        <td style="text-align:center">{{$device->category}}</td>
        @if(Auth::user()->type =='admin')
        <td style="text-align:center"><a href="{{action('rejectController@edit', $device->id)}}" class="btn btn-outline-success">Accept</a></td>

       @endif
      </tr>
      @endforeach
    </tbody>
  </table>


          </div>
      </div>



  </section>

@endsection
