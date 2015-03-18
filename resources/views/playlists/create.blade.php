@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <h1>Create playlist</h1>
            <form action="{{ route('playlists.store') }}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" maxlength="100" name="name" id="name">
                </div>
                <button class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@stop