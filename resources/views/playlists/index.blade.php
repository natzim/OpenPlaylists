@extends('app')

@section('content')
    <div class="page-header">
        <h1>Playlists</h1>
    </div>
    <form>
        <div class="form-group">
            <label for="search">Search</label>
            <input class="form-control" type="text" name="search" id="search" value="{{ old('search') }}">
        </div>
        <div class="form-group">
            <div class="well">
                <label for="genre" data-toggle="slide" data-target=".treeview">Genre</label>
                @include('partials.genre-select')
            </div>
        </div>
        <button class="btn btn-primary">
            <i class="fa fa-search"></i>
            Search
        </button>
    </form>
    <hr>
    @include('partials.playlistlist')
@stop

@section('scripts')
    <script src="/vendor/bootstrap-treeview/dist/bootstrap-treeview.min.js"></script>
    <script src="/js/genre-select.js"></script>
@stop