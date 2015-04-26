# OpenPlaylists TODO

## Functionality

### Playlists

- [ ] Creation of playlists
- [ ] Editing of playlists
- [ ] Favouriting/saving of playlists
- [x] Searching for a specific genre should also retrieve results from its subgenres
- [x] Fix pagination on search results with a specific genre or search term. Issue [#2](/natzim/OpenPlaylists/issues/2)

### Genres

- [ ] Creation of genres by admin
- [ ] Editing of genres by admin
- [ ] Genre suggestion

### Users

- [ ] Admin role

## Performance

- [ ] Cache search results
- [x] Eager loading

## Development

- [ ] Add foreign keys
- [ ] Move playlist fork logic out of the controller
- [x] Gulp to manage resources
- [x] Fix `Model::unguard()` needing to be called twice. Issue [#1](/natzim/OpenPlaylists/issues/1)
