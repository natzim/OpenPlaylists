<div class="list-group">
    @foreach($playlists as $playlist)
        <div class="list-group-item">
            <a href="{{ route('playlists.show', $playlist->slug) }}">{{ $playlist->name }}</a>
            @if (!empty($playlist->genre->name))
                <span class="label label-default">{{ $playlist->genre->name }}</span>
            @endif
            <span class="badge">{{ $playlist->songs->count() }}</span>
        </div>
    @endforeach
</div>