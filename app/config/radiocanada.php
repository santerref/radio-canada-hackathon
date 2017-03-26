<?php

return [

    'client_key' => env('RADIOCANADA_CLIENT_KEY', false),

    'base_uri' => env('RADIOCANADA_BASE_URL', 'https://services.radio-canada.ca'),

    'page_size' => env('RADIOCANADA_PAGE_SIZE', 100),

    'media_uri' => env('RADIOCANADA_MEDIA'),

    'ffmpeg' => env('RADIOCANDA_FFMPEG', '/usr/local/bin/ffmpeg'),

];
