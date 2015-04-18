@extends('app')

@section('content')
    <div class="page-header">
        <h1>Edit playlist</h1>
    </div>

    @include('partials.errors', compact($errors))

    {!! Form::model($playlist, ['route' => ['playlists.update', $playlist->slug], 'method' => 'put']) !!}
        <div class="form-group">
            {!! Form::label('name', 'Name') !!}
            {!! Form::text('name', null, ['class' => 'form-control', 'maxlength' => '100']) !!}
        </div>
        <div class="list-group">
            @foreach ($playlist->songs as $key => $song)
                <a href="#" class="list-group-item" data-video-id="{{ $song->youtube_id }}">
                    {{ $song->name }}
                    {!! Form::hidden('songs[]') !!}
                </a>
            @endforeach
        </div>
        <button class="btn btn-primary">Submit</button>
    {!! Form::close() !!}
@stop