<?php

declare(strict_types=1);

namespace Features\Application\Page;

class DocumentationPage extends AbstractBasePage
{
    /**
     * @var string
     */
    protected $path = 'doc';

    /**
     * @var array
     */
    protected $elements = [
        'swagger' => '#swagger-ui'
    ];

    public function hasSwagger(): bool
    {
        return $this->hasElement('swagger');
    }
}
