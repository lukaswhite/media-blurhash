<?php


namespace Lukaswhite\MediaBlurhash;


use Bepsvpt\Blurhash\Facades\BlurHash;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Intervention\Image\ImageManager;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * Class BlurhashMedia
 * @package Lukaswhite\MediaBlurhash
 */
class BlurhashMedia implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Media
     */
    protected $media;

    /**
     * BlurhashMedia constructor.
     * @param Media $media
     */
    public function __construct(Media $media)
    {
        $this->media = $media;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $hash = BlurHash::encode((new ImageManager())->make($this->media->getUrl()));
        $this->media->update(['blurhash' => $hash]);
    }
}
