@extends('layouts.app')

@section('content')

<link href="{{ asset('css/back.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/backend_css/bootstrap.min.css') }}" />
		<link rel="stylesheet" href="{{ asset('css/backend_css/bootstrap-responsive.min.css') }}" />


<div class="slider">
<div class="load"></div>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div id="img-holder" class="panel panel-default">


                <div class="panel-body">
                    <form class="form-horizontal" method="POST"  action="{{ url('send/email') }}">
                         {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label id="cl1" for="email" class="col-md-4 control-label">Email Address</label>


                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Send Password Reset Link
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

</div>
</div>
@endsection
