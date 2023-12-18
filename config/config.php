<?php

return [
    /**
     * If this is set to TRUE then the package will calculate the blurhash whenever a new media
     * model is created. Set it to FALSE if you'd prefer to do it manually.
     *
    'run_on_created' => true,

    /**
     * List of mime types that represent *supported* images
     */
    'image_mime_types' => [
        'image/jpeg',
        'image/png',
    ],

    'queue' => null,
];
