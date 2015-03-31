@extends('app')

@section('content')
    <div class="page-header">
        <h1>Reset password</h1>
    </div>

    @include('partials.errors', compact($errors))

    <form method="post" action="{{ url('/password/reset') }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="token" value="{{ $token }}">

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
            <button class="btn btn-primary">Reset Password</button>
        </div>
    </form>
@stop
