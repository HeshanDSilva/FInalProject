@extends('layouts.master')

@section('content')
<div class="content-wrapper ScrollStyle vl table-dark">
<br>
  <div class="page-header text-center table-dark" style="border:1px solid white;">
    <h3>All Users</h3>
  </div>
  <!-- Main content -->
<section class="content">
<div class="container">
  @include('inc.Errors')
</div>
<div class="widget-content nopadding">
<div class="row">
  <div class="col-md-6">
      @if(Auth::user()->type =='admin')
        <button type="submit" name="btn_submit" class="btn btn-outline-danger" data-toggle="modal" data-target="#myModal" tabindex="14" onclick="block()"><i class="fa fa-plus"></i> Add</strong></button>
        <div id="myModal" class="modal fade" tabindex="-1" style="color:black">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title">Add new user</h4>
              </div>
              <div class="modal-body">

                <p> <button class="btn btn-outline-primary" onclick="disable()">Web User</button>   <button class="btn btn-outline-danger" onclick="enable()">System user</button> </p>
                 <form role="form" method="POST" action="{{url('UserDetails')}}">
                    {{ csrf_field() }}
                      <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Name</label>
                        <div class="controls">
                          <input type="text" class="form-control" name="name" placeholder="Name" id="name1"/>
                          @if ($errors->has('name'))
                              <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                              </span>
                          @endif
                        </div>
                      </div>
              <div class="control-group">
                <label class="col-form-label">Email :</label>
                <div class="controls">
                <input type="email" class="form-control" name="email" placeholder="Email" id="email"/>
                  @if ($errors->has('email'))
                      <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                      </span>
                  @endif
                </div>
              </div>
              <div class="control-group">
                <label class="col-form-label">Password :</label>
                <div class="controls">
                  <input type="password"  class="form-control" name="password" placeholder="Enter Password"  id="password"/>
                  @if ($errors->has('password'))
                    <span class="help-block">
                       <strong>{{ $errors->first('password') }}</strong>
                    </span>
                  @endif
                </div>
              </div>
              <div class="control-group">
                <label class="col-form-label">Contact :</label>
                <div class="controls">
                  <input type="text" class="form-control" name="contact" placeholder="contact" id="contact"/>
                  @if ($errors->has('contact'))
                    <span class="help-block">
                      <strong>{{ $errors->first('contact') }}</strong>
                    </span>
                  @endif
                </div>
              </div>
              <div class="control-group">
                <label class="col-form-label">State :</label>
                <div class="controls">
                  <input type="text" class="form-control" name="region" placeholder="State" id="name"/>
                  @if ($errors->has('region'))
                      <span class="help-block">
                            <strong>{{ $errors->first('region') }}</strong>
                      </span>
                  @endif
                </div>
              </div>
              <div class="control-group">
                <label class="col-form-label">City :</label>
                <div class="controls">
                  <input type="text" class="form-control" name="city" placeholder="City" id="city"/>
                  @if ($errors->has('city'))
                    <span class="help-block">
                      <strong>{{ $errors->first('city') }}</strong>
                    </span>
                  @endif
                </div>
              </div>
              <div class="control-group">
                <label class="col-form-label">Zip Code :</label>
                <div class="controls">
                  <input type="text" class="form-control" name="zipcode" placeholder="zip code" id="zipcode"/>
                  @if ($errors->has('zipcode'))
                    <span class="help-block">
                        <strong>{{ $errors->first('zipcode') }}</strong>
                    </span>
                  @endif
                </div>
              </div>
              <div class="control-group">
                <label class="col-form-label">Job Type :</label>
                <div class="controls">
               <select class="form-control" name="type" id="typeweb" placeholder="job type">
                <option>admin</option>
                  <option>editor</option>
                  <option>technician</option>
                </select>
                </div>
              </div>
              <div class="control-group">
                <label class="col-form-label">Category :</label>
               <select class="form-control" name="type" id="type" placeholder="job type">
                     <option selected="selected">Select Category</option>
                     @foreach($categories as $category)
                      <option value="{{$category->category_name }}">{{$category->category_name }}</option>
                     @endforeach
               </select>
              </div>
              <br>
              <div class="form-group">
                  <div>
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-outline-success">
                                Submit
                        </button>
                    </div>
                </div>
            </form>

              </div>
          </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  @endif
</div>
<div class="col-md-6">
  <br>
  <form action="/searchuser" method="POST" role="search">
      {{ csrf_field() }}
      <div class="row">
          <div class="col-lg-12 col-lg-offset-12">
              <input type="search" id="search" name="search" class="form-control" placeholder="Search & Enter">
          </div>
      </div>
  </form>
</div>
</div>
</div>
<br>
 <table class="table table-striped table-dark">
 <thead>
   <tr class="alert-success">
     <th style="text-align:center">ID</th>
     <th style="text-align:center" >Name</th>
     <th style="text-align:center">Email</th>
     <th style="text-align:center">Contact</th>
     <th style="text-align:center">Type</th>
      @if(Auth::user()->type =='admin')
     <th colspan="2" style="text-align:center">Action</th>
     @endif
   </tr>
 </thead>
 <tbody>
   @foreach($users as $user)
   <tr>
     <td style="text-align:center">{{$user->id}}</td></h3>
     <td style="text-align:center">{{$user->name}}</td>
     <td style="text-align:center">{{$user->email}}</td>
     <td style="text-align:center">{{$user->contact}}</td>
     <td style="text-align:center">{{$user->type}}</td>
     @if(Auth::user()->type =='admin')
      <td><a href="{{action('UserDetailsController@edit', $user->id)}}" class="btn btn-outline-warning">Edit</a>
     @endif
   </tr>
   @endforeach
 </tbody>
</table>
</div>
</div>

<script>
      function disable() {
        document.getElementById("name").disabled = true;
        document.getElementById("city").disabled = true;
        document.getElementById("zipcode").disabled = true;
        document.getElementById("typeweb").disabled = false;
        document.getElementById("type").disabled = true;
        document.getElementById("name1").disabled = false;
        document.getElementById("contact").disabled = false;
        document.getElementById("email").disabled = false;
        document.getElementById("password").disabled = false;
        }
function enable() {
        document.getElementById("name").disabled = false;
        document.getElementById("city").disabled = false;
        document.getElementById("zipcode").disabled = false;
        document.getElementById("typeweb").disabled = true;
        document.getElementById("type").disabled = false;
        document.getElementById("name1").disabled = false;
        document.getElementById("contact").disabled = false;
        document.getElementById("email").disabled = false;
        document.getElementById("password").disabled = false;
      }

function block() {
        document.getElementById("name").disabled = true;
        document.getElementById("city").disabled = true;
        document.getElementById("zipcode").disabled = true;
        document.getElementById("typeweb").disabled = true;
        document.getElementById("type").disabled = true;
        document.getElementById("name1").disabled = true;
        document.getElementById("contact").disabled = true;
        document.getElementById("email").disabled = true;
        document.getElementById("password").disabled = true;
      }
</script>
</section>

@endsection
