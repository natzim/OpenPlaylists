# OpenPlaylists

Open playlists is an easy way of sharing music playlists.

If you want to change a playlist, you can fork it and create your own version.

## Installation

Clone the repo

```
git clone https://github.com/natzim/OpenPlaylists
```

Rename the example environment file

```
mv .env.example .env
```

Install resources

```
bower install
```

Set up databases

```
php artisan migrate
```

Seed databases (for testing)

```
php artisan db:seed
```

## Contributing

For details on contributing to this project, please read the [contributing document](CONTRIBUTING.md)
