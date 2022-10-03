<?php

declare(strict_types=1);

namespace Esky\Application\Model\DTO;

use OpenApi\Annotations as OA;
use JMS\Serializer\Annotation as JMS;

class Result
{
    /**
     * @OA\Property(description="The names of the search directions.")
     * @JMS\Type("array<string>")
     */
    public array $search = [];

    /**
     * @OA\Property(description="The best direction.")
     * @JMS\Type("Esky\Application\Model\DTO\Direction")
     */
    public ?Direction $bestDirection = null;

    /**
     * @OA\Property(description="The best direction.")
     * @JMS\Type("array<Esky\Application\Model\DTO\Direction>")
     */
    public array $directions = [];
}
