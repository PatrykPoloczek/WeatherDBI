<?php

declare(strict_types=1);

namespace Features\Application;

use Behat\Gherkin\Node\PyStringNode;

class DatabaseContext extends AbstractDatabaseContext
{
    /**
     * @BeforeScenario @purgeData
     */
    public function truncateCollection(): void
    {

    }

    /**
     * @Then the number of documents in the database should equal :number
     */
    public function theNumberOfDocumentsInTheDatabaseShouldEqual(int $number): void
    {
        $numberOfDocuments = 3;

        if ($numberOfDocuments !== $number) {
            throw new \RuntimeException(
                sprintf('%d documents expected, but %d found!', $number, $numberOfDocuments)
            );
        }
    }

    /**
     * @Then there are following documents in the database
     */
    public function thereAreFollowingDocumentsInTheDatabase(PyStringNode $data): void
    {
        $serializedDocuments = $this->get('jms_serializer')->serialize([], 'json');

        $this->match($data->getRaw(), $serializedDocuments);
    }
}
