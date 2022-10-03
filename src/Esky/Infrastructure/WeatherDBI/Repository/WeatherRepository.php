<?php

declare(strict_types=1);

namespace Esky\Infrastructure\WeatherDBI\Repository;

use Esky\Infrastructure\WeatherDBI\ClientInterface;
use Esky\Infrastructure\WeatherDBI\Model\Weather;
use JMS\Serializer\SerializerInterface;

class WeatherRepository implements WeatherRepositoryInterface
{
    private ClientInterface $client;
    private SerializerInterface $serializer;

    public function __construct(ClientInterface $client, SerializerInterface $serializer)
    {
        $this->client = $client;
        $this->serializer = $serializer;
    }

    public function getWeatherByDirection(string $destination): Weather
    {
        $data = $this->client->get(sprintf('weather/%s', $destination));

        if (strpos($data, 'fail') !== false) {
            throw new \Exception($data);
        }

        return $this->serializer->deserialize($data, Weather::class, 'json');
    }
}
