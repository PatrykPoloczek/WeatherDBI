<?php

declare(strict_types=1);

namespace Esky\Application\Controller\Page;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function indexAction(): Response
    {
        return $this->redirectToRoute('app.swagger_ui');
    }
}
