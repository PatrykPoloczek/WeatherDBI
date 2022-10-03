<?php

declare(strict_types=1);

namespace Features\Application;

use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\Persistence\ObjectRepository;
use MongoDB\Collection;

abstract class AbstractDatabaseContext extends AbstractKernelContext
{
    use DataMatcherTrait;

    protected function getDocumentManager(): DocumentManager
    {
        return $this->get('doctrine_mongodb.odm.document_manager');
    }

    protected function getDocumentCollection(string $className): Collection
    {
        return  $this->getDocumentManager()->getDocumentCollection($className);
    }

    protected function getRepository(string $documentName): ObjectRepository
    {
        return  $this->getDocumentManager()->getRepository($documentName);
    }
}
