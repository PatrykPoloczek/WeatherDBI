<?php

declare(strict_types=1);

namespace Esky\Infrastructure\WeatherDBI\Repository;

use Esky\Infrastructure\WeatherDBI\ClientInterface;
use Esky\Infrastructure\WeatherDBI\Model\Weather;
use JMS\Serializer\SerializerInterface;

class FakeWeatherRepository implements WeatherRepositoryInterface
{
    private SerializerInterface $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function getWeatherByDirection(string $destination): Weather
    {
        $src = sprintf('%s/mountebank/response/%s.json', FIXTURES_DIR, strtolower($destination));
        $data = file_get_contents($src);

        if (!$data) {
            throw new \Exception('File not found');
        }

        return $this->serializer->deserialize($data, Weather::class, 'json');
    }
}
