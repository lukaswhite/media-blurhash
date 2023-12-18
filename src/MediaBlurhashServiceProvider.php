<?php

namespace Lukaswhite\MediaBlurhash;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Lukaswhite\MediaBlurhash\Console\Commands\BlurhashMediaCommand;
use Spatie\MediaLibrary\MediaCollections\Events\MediaHasBeenAddedEvent;

class MediaBlurhashServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('media-blurhash.php'),
            ], 'config');

            // The migration needs to have the current time as its timestamp, to ensure that
            // it only gets run AFTER the media table has been created.
            $migrationSrc = '0000_00_00_000000_add_blurhash_to_media_table.php';

            $migrationDest = str_replace(
                '0000_00_00_000000',
                now()->format('Y_m_d_His'),
                $migrationSrc
            );

            $this->publishes([
                sprintf('%s/../migrations/%s', __DIR__, $migrationSrc) =>
                    database_path(sprintf('migrations/%s', $migrationDest)),
            ], 'migrations');

            $this->commands([
                BlurhashMediaCommand::class,
            ]);
        }

        if(config('media-blurhash.run_on_created')){
            Event::listen([
                MediaHasBeenAddedEvent::class,
            ], MediaBlurhashListener::class);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'media-blurhash');
    }

    private function migrationPath(string $file): string
    {
        $timestamp = date('Y_m_d_His', time() - --$this->migrationCount);
        return database_path(
            sprintf('migrations/%s_%s.php', $timestamp, $file)
        );
    }
}
