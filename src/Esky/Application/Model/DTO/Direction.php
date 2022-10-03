<?php

declare(strict_types=1);

namespace Esky\Application\Model\DTO;

use OpenApi\Annotations as OA;
use JMS\Serializer\Annotation as JMS;

class Direction
{
    /**
     * @OA\Property(description="The region name of the direction.")
     */
    public string $region = '';

    /**
     * @OA\Property(description="The score of the direction.")
     */
    public int $score = 0;

    /**
     * @OA\Property(description="The temperature of the direction.")
     */
    public ?int $temperature = null;

    /**
     * @OA\Property(description="The rainfall of the direction.")
     */
    public ?int $rainfall = null;

    /**
     * @OA\Property(description="The humidity of the direction.")
     */
    public ?int $humidity = null;

    /**
     * @OA\Property(description="The wind of the direction.")
     */
    public ?int $wind = null;
}
