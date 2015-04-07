<table class="table table-striped">
    <thead>
        <tr>
            <th>Name</th>
            <th>Genre</th>
            <th>Songs</th>
        </tr>
    </thead>
    <tbody>
        @foreach($playlists as $playlist)
            <tr>
                <td>
                    <a href="{{ route('playlists.show', $playlist->slug) }}">{{ $playlist->name }}</a>
                </td>
                <td>
                    @if (!empty($playlist->genre->name))
                        @include('partials.genre', ['genre' => $playlist->genre])
                    @endif
                </td>
                <td>
                    <span class="badge">{{ $playlist->songs->count() }}</span>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
