@extends('layouts.master')

@section('content')
<div class="content-wrapper ScrollStyle vl table-dark">
  <!-- Content Header (Page header) -->
<section class="content">
<div class="widget-content nopadding">
  <br>
<div class="container">
  @include('inc.Errors')
</div>

<div class="alert-success text-white p-3">
<form action="/searchdesableuser" method="POST" role="search">
    {{ csrf_field() }}
    <div class="row">
      <div class="col-md-7">
          <h3>Dissable users</h3>
      </div>
        <!--<div class="col-md-5">
            <input type="search" id="search" name="search" class="form-control" placeholder="Search & Enter">
        </div>-->
    </div>

</form>
</div>

   <br>
    <table class="table table-striped table-dark">
    <thead>
      <tr class="alert-success">
        <th style="text-align:center">ID</th>
        <th style="text-align:center">Name</th>
        <th style="text-align:center">Email</th>
        <th style="text-align:center">Contact</th>
        <th style="text-align:center">Type</th>
        <th style="text-align:center">Zip Code</th>
        @if(Auth::user()->type =='admin')
        <th colspan="2" style="text-align:center">Action</th>
        @endif
      </tr>
    </thead>
    <tbody>
      @foreach($users as $user)
     @if( $user->state == 'Deactive' )
      <tr>
        <td style="text-align:center">{{ $user->user_id }}</td></h3>
        <td style="text-align:center">{{ $user->name }}</td>
        <td style="text-align:center">{{ $user->email }}</td>
        <td style="text-align:center">{{ $user->contact }}</td>
        <td style="text-align:center">{{ $user->type }}</td>
        <td style="text-align:center">{{ $user->zipcode }}</td>
        <td style="text-align:center"><a href="{{action('DisabledUserController@edit', $user->user_id)}}" class="btn btn-outline-success">Active</a></td>
      </tr>
      @endif
      @endforeach
    </tbody>
  </table>
</div>
</div>
</section>

@endsection
