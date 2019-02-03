@extends('layouts.master')

@section('content')
<div class="content-wrapper ScrollStyle vl">
  <br>
  <div class="container">
    @include('inc.Errors')
  </div>
  <br>
<div class="container">
  <form method="POST" action="/user-register" accept-charset="UTF-8" id="formcontrol" enctype="multipart/form-data">
  @csrf
  <div class="form-group">
    <label for="inputAddress">User Name :-</label>
    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" >
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Email :-</label>
      <input class="form-control" placeholder="example@gmail.com" name="email" type="email" value="" id="email">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Password :-</label>
      <input class="form-control" placeholder="Enter Default password" name="password" type="password" value="" id="password">
    </div>
    </div>
  <div class="form-group">
    <label for="inputAddress2">Contact No :-</label>
    <input class="form-control" placeholder="07x-xxxxxxx" name="contact" type="text" value="" id="contact">
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputCity">City :-</label>
      <input class="form-control" placeholder="Place City here" name="city" type="text" value="" id="city">
    </div>
    <div class="form-group col-md-4">
      <label for="inputState">State :-</label>
      <input class="form-control" placeholder="Place State here" name="state" type="text" value="" id="state">
    </div>
    <div class="form-group col-md-2">
      <label for="inputZip">Zip :-</label>
      <input class="form-control" placeholder="Enter Zipcode here" name="zipcode" type="text" value="" id="zipcode">
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputState">Type :-</label>
      <select id="type" name="type" class="form-control">
        <option selected>Select Type</option>
        <option>admin</option>
        <option>editor</option>
        <option>technician</option>
      </select>
    </div>
    <div class="form-group col-md-6">
      <label for="inputState">Category :-</label>
      <select id="category" name="category" class="form-control" Disabled>
        <option selected>Select Category</option>
        <option>Dealer</option>
        <option>Distributor/option>
        <option>Retail</option>
      </select>
    </div>
  </div>
      <div class="row">
      <div class="col-md-3">
      <div class="form-group">
        <button type="submit" class="btn btn-lg send-data btn-block btn-outline-dark">Save</button>
      </div>
      </div>
    </div>
</div>
</form>
</div>
  <br>
</div>
@endsection
