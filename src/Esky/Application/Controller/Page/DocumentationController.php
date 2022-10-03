<?php

declare(strict_types=1);

namespace Esky\Application\Controller\Page;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class DocumentationController extends AbstractController
{
    private string $apiTitle;

    public function __construct(string $apiTitle)
    {
        $this->apiTitle = $apiTitle;
    }

    public function indexAction(): Response
    {
        return $this->render('documentation.html.twig', [
            'apiTitle' => $this->apiTitle,
            'data' => [
                'urls' => [[
                    'url' => $this->generateUrl('app.swagger'),
                    'name' => $this->apiTitle
                ]],
                'validatorUrl' => null
            ]
        ]);
    }
}
