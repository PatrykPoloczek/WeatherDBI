<?php

declare(strict_types=1);

namespace Esky\Infrastructure\WeatherDBI\Factory;

use Esky\Infrastructure\WeatherDBI\Client\GuzzleClient;
use Esky\Infrastructure\WeatherDBI\ClientFactoryInterface;
use Esky\Infrastructure\WeatherDBI\ClientInterface;
use GuzzleHttp\Client;

class GuzzleClientFactory implements ClientFactoryInterface
{
    private string $baseUrl;

    public function __construct(string $baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }

    public function create(): ClientInterface
    {
       $client = new Client([
           'base_uri' => $this->baseUrl,
       ]);

       return new GuzzleClient($client);
    }
}
