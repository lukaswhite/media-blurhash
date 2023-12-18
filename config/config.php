<?php

return [
    /**
     * If this is set to TRUE then the package will calculate the blurhash whenever a new media
     * model is created.
     *
     * However, this is not always desirable. If you're using remote file storage such as
     * S3, the model may be created before the file is available; in which case you'll need
     * to fire the job yourself.
     */
    'run_on_created' => true,

    /**
     * List of mime types that represent *supported* images
     */
    'image_mime_types' => [
        'image/jpeg',
        'image/png',
    ],

    'queue' => [

        /**
         * Optionally specify the name of the queue to use
         */
        'name' => null,

        /**
         * Optionally override the queue
         */
        'connection' => null,
    ],
];
