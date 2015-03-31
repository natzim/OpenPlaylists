@extends('app')

@section('content')
    <div class="page-header">
        <h1>Login</h1>
    </div>

    @include('partials.errors', compact($errors))

    <form method="post" action="{{ url('/auth/login') }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="form-group">
            <label for="name">Username</label>
            <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" maxlength="20">
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" id="password">
        </div>

        <div class="form-group">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="remember"> Remember Me
                </label>
            </div>
        </div>

        <div class="form-group">
            <button class="btn btn-primary">Login</button>
            <a class="btn btn-link" href="{{ url('/password/email') }}">Forgot Your Password?</a>
        </div>
    </form>
@stop
