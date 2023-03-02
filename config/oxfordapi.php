<?php

    /*
    |--------------------------------------------------------------------------
    | Oxford Dictionaries API Config
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for Oxford Dictionaries API.
    | Find your Application ID and key at: https://developer.oxforddictionaries.com
    |
    */

return [
    'base_uri' => env('OXFORDAPI_BASE_URI', 'https://od-api.oxforddictionaries.com/api/v2'),
    'app_id' => env('OXFORDAPI_ID', ''),
    'app_key' => env('OXFORDAPI_KEY', '')
];