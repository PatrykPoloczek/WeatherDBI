<?php

declare(strict_types=1);

namespace Features\Application;

use Behat\MinkExtension\Context\RawMinkContext;
use Behat\Symfony2Extension\Context\KernelAwareContext;
use Behat\Symfony2Extension\Context\KernelDictionary;
use Features\Application\Page\DocumentationPage;
use Features\Application\Page\MainPage;

class DocumentationContext extends RawMinkContext implements KernelAwareContext
{
    use KernelDictionary;
    use DataMatcherTrait;

    /**
     * @var MainPage
     */
    private $mainPage;

    /**
     * @var DocumentationPage
     */
    private $documentationPage;

    public function __construct(MainPage $mainPage, DocumentationPage $demoPage)
    {
        $this->mainPage = $mainPage;
        $this->documentationPage = $demoPage;
    }

    /**
     * @When I visit the main page
     */
    public function iVisitTheMainPage(): void
    {
        $this->mainPage->openPage();
    }

    /**
     * @When I visit the documentation page
     */
    public function iVisitTheDocumentationPage()
    {
        $this->documentationPage->openPage();
    }

    /**
     * @Then I should be redirecting to documentation page
     */
    public function iShouldBeRedirectingToDocumentationPage(): void
    {
        if (!$this->documentationPage->isOpened()) {
            throw new \RuntimeException('Documentation page is not opened!');
        }
    }

    /**
     * @Then I should swagger documentation on the page
     */
    public function iShouldSwaggerDocumentationOnThePage()
    {
        if (!$this->documentationPage->hasSwagger()) {
            throw new \RuntimeException('Documentation page does not have swagger!');
        }
    }
}
