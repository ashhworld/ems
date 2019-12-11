@extends('master')


@section('content')


    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Employee Login</h2>
            </div>
        </div>
    </div>

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="post" action="{{ '/users/validation' }}">
        <div class="row">
            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
            <div class="col-xs-12 col-sm-12 col-md-12  text-center">
                <div class="col-xs-12 col-sm-6 col-md-6 center">
                    <strong>Email ID:</strong>
                    <input type="text" name="user_name" id="user_name" value="" class = 'form-control' placeholder="Enter Email ID">
                </div>
                <div class="clearfix"></div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <strong>Password:</strong>
                    <input type="password" name="password" id="password" value="" class = 'form-control' placeholder="Enter Password">
                </div>
            </div>

            <div class="col-xs-12 col-sm-6 col-md-6 text-center">
                <button type="submit" id="login" class="btn btn-primary">Login</button>
            </div>
        </div>
    </form>

@endsection