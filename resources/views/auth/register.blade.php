@extends('app')

@section('content')
    <div class="page-header">
        <h1>Register</h1>
    </div>

    @include('partials.errors', compact($errors))

    <form method="post" action="{{ url('/auth/register') }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="form-group">
            <label for="name">Username</label>
            <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" maxlength="20">
        </div>

        <div class="form-group">
            <label for="email">E-Mail Address</label>
            <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}">
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" id="password">
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
        </div>

        <div class="form-group">
            <button class="btn btn-primary">Register</button>
        </div>
    </form>
@stop
