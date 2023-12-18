# Media Blurhash

A very simple package for Laravel that calculates the BlurHash of images added via Spatie's Laravel Media Library, which you can then use as placeh
older images.

 - [BlurHash](https://blurha.sh/)
 - [Laravel Media Library](https://spatie.be/docs/laravel-medialibrary)

## Installation

You can install the package via composer:

```bash
composer require lukaswhite/media-blurhash
```

## Usage

> IMPORTANT: Before running the migration, ensure you have run the media library package's migrations, as it adds a new column to the `media` table.

Publish the migration:

```bash
php artisan vendor:publish --provider="Lukaswhite\MediaBlurhash\MediaBlurhashServiceProvider" --tag=migrations
```

Run the migration:

```bash
php artisan migrate
```

Optionally publish the config:

```bash
php artisan vendor:publish --provider="Lukaswhite\MediaBlurhash\MediaBlurhashServiceProvider" --tag=config
```

This adds a `blurhash` column to the `media` table, which you can subsequently use to display a BlurHash, return in an API call etc.

By default, the package will calculate the BlurHash whenever an image is added via the media library. You can disable this in the config should you wish.

### Manually Calculating the BlurHash

If you'd prefer to run the hashing process manually, you can either dispatch the package's job manually:

```php
use Lukaswhite\MediaBlurhash\BlurhashMedia;

/** @var \Spatie\MediaLibrary\MediaCollections\Models\Media $media */
BlurhashMedia::dispatch($this->media);
``` 

Or, to use the package configuration's queue connection and/or name:

```php
use Lukaswhite\MediaBlurhash\Utils\Dispatcher;

/** @var \Spatie\MediaLibrary\MediaCollections\Models\Media $media */
(new Dispatcher($media))->run();
```

### Customising the Queue

You can tell the package to use a specific queue connection and/or name by publishing the config file and setting the appropriate values.

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email hello@lukaswhite.com instead of using the issue tracker.

## Credits

-   [Lukas White](https://github.com/lukaswhite)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
