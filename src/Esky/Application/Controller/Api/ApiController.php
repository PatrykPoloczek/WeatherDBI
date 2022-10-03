<?php

declare(strict_types=1);

namespace Esky\Application\Controller\Api;

use FOS\RestBundle\View\View;
use OpenApi\Annotations as OA;
use Esky\Application\Model\DTO;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Esky\Infrastructure\WeatherDBI\Handler\ResultHandlerInterface;
use Esky\Infrastructure\WeatherDBI\Repository\WeatherRepositoryInterface;

class ApiController extends AbstractFOSRestController
{
    private WeatherRepositoryInterface $repository;
    private ResultHandlerInterface $resultHandler;

    public function __construct(
        WeatherRepositoryInterface $repository,
        ResultHandlerInterface $resultHandler
    ) {
        $this->repository = $repository;
        $this->resultHandler = $resultHandler;
    }

    /**
     * @Rest\Get("/weather/{search}")
     *
     * @OA\Tag(name="Weather")
     *
     * @OA\Parameter(
     *   name="search",
     *   in="path",
     *   description="Directions.",
     *   @OA\Schema(type="string")
     * )
     *
     * @OA\Response(
     *   response=200,
     *   description="Returns weather data.",
     *   @Model(type=DTO\Result::class)
     * )
     *
     * @OA\Response(
     *   response=404,
     *   description="Data not found."
     * )
     */
    public function weatherAction(string $search): View
    {
        try {
            $destinations = [];
            $searches = explode(',', $search);
            foreach ($searches as $dest) {
                $destinations[] = $this->repository->getWeatherByDirection($dest);
            }

            $result = $this->resultHandler->handle($destinations);

            $result->search = $searches;
        } catch(\Exception $exception) {
            throw new NotFoundHttpException();
        }

        return $this->view($result, Response::HTTP_OK);
    }
}
