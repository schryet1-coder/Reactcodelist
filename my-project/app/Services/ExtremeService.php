<?php

namespace App\Services;

use GuzzleHttp\Client;

class ExtremeService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client(['timeout' => 10]);
    }

    /**
     * Fetch channels by extreme code from configured API.
     * Returns array of channels with keys: name, identifier, meta
     */
    public function fetchChannels(string $code): array
    {
        $url = env('EXTREME_API_URL');
        $key = env('EXTREME_API_KEY');

        if (!$url) {
            return [];
        }

        try {
            $res = $this->client->request('GET', $url, [
                'query' => ['code' => $code],
                'headers' => $key ? ['Authorization' => "Bearer {$key}"] : [],
            ]);

            $body = json_decode((string)$res->getBody(), true);

            // Normalize response to channels array
            if (isset($body['channels']) && is_array($body['channels'])) {
                return $body['channels'];
            }

            // Fallback: if API returns array
            if (is_array($body)) {
                return $body;
            }
        } catch (\Exception $e) {
            // log and return empty
            logger()->error('ExtremeService fetch error: ' . $e->getMessage());
        }

        return [];
    }
}
