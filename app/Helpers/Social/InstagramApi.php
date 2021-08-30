<?php

namespace App\Helpers\Social;

use Illuminate\Support\Facades\Http;

class InstagramApi
{
    public function instagramApiFn($username)
    {
        return Http::get(
            'https://graph.facebook.com/v3.2/17841403423395022',
            [
                'fields' => "business_discovery.username($username){followers_count,media_count}",
                'access_token' => 'EAAMZCRSPJvCcBAJT7NzjNAru1A1pQaUQrQMZCjpGhyLZA2cNiq55jMcWnGCzCAcuDM2Gx84mdXuP6aBSsMJQ4B1eCFZBFGM6DBgnD2IkyJiFQspZCyfidyofOL8UGZBcnh7fFHbiK2CX73pOPOOUHmgxsB9R2vlBEO3Ww06gZBoCQeF2ZBGlNZB5BaUMQ5yC5wwPGg3XEmyzoBgZDZD',
            ]
        );
    }
}
