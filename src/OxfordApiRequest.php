<?php

namespace Mridhulka\LaravelOxfordDictionariesApi;

use Illuminate\Support\Facades\Http;

class OxfordApiRequest
{
    public static function execute(string $endpoint, array $query = null)
    {
        $res = Http::acceptJson()->withHeaders([
            'app_id' => config('oxfordapi.app_id'),
            'app_key' => config('oxfordapi.app_key'),
        ])->baseUrl('https://od-api.oxforddictionaries.com/api/v2')->get($endpoint, $query)->json();

        return $res;
    }
}
