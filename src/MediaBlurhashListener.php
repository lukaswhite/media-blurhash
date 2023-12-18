<?php

namespace Lukaswhite\MediaBlurhash;

use Lukaswhite\MediaBlurhash\Utils\Dispatcher;
use Lukaswhite\MediaBlurhash\Utils\ImageChecker;
use Spatie\MediaLibrary\MediaCollections\Events\MediaHasBeenAddedEvent;

/**
 * Class MediaBlurhashListener
 * @package Lukaswhite\MediaBlurhash
 */
class MediaBlurhashListener
{
    /**
     * Handle the event.
     */
    public function handle(MediaHasBeenAddedEvent $event): void
    {
        if((new ImageChecker($event->media))->isImage()){
            (new Dispatcher($event->media))->run();
        }
    }

}
