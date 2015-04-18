# OpenPlaylists

Open playlists is an easy way of sharing music playlists.

If you want to change a playlist, you can fork it and create your own version.

## Installation

First, make sure you have `npm`, `gulp` and `bower` installed.

Clone the repo

```
git clone https://github.com/natzim/OpenPlaylists
```

Rename the example environment file

```
mv .env.example .env
```

Install npm dependencies

```
npm install
```

Install resources

```
bower install
gulp
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
