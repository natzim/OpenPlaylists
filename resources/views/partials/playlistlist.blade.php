<div class="list-group">
    @foreach($playlists as $playlist)
        <div class="list-group-item">
            <a href="{{ route('playlists.show', $playlist->slug) }}">{{ $playlist->name }}</a>
            <span class="badge">{{ $playlist->songs->count() }}</span>
        </div>
    @endforeach
</div>