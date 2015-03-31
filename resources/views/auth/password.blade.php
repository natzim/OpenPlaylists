@extends('app')

@section('content')
    <div class="page-header">
        <h1>Reset password</h1>
    </div>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    @include('partials.errors', compact($errors))

    <form method="post" action="{{ url('/password/email') }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="form-group">
            <label for="email">E-Mail Address</label>
            <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}">
        </div>

        <div class="form-group">
            <button class="btn btn-primary">Send Password Reset Link</button>
        </div>
    </form>
@stop
