<?php


namespace Lukaswhite\MediaBlurhash\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Lukaswhite\MediaBlurhash\BlurhashMedia;
use Lukaswhite\MediaBlurhash\Utils\Dispatcher;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class BlurhashMediaCommand extends Command
{
    use DispatchesJobs;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'media-blurhash:blurhash-media';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculates the Blurhash of all media records where required';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $media = Media::query()
            ->whereIn('mime_type', config('media-blurhash.image_mime_types'))
            ->whereNull('blurhash')
            ->get();

        $media->each(function (Media $media){
            (new Dispatcher($media))->run();
        });
    }
}
