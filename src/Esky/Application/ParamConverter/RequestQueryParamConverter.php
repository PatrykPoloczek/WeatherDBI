<?php

declare(strict_types=1);

namespace Esky\Application\ParamConverter;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;

final class RequestQueryParamConverter implements ParamConverterInterface
{
    /**
     * {@inheritdoc}
     */
    public function apply(Request $request, ParamConverter $configuration): bool
    {
        $className = $configuration->getClass();
        $object = new $className();
        $keys = get_class_vars($className);

        foreach ($keys as $key => $default) {
            $object->{$key} = $request->query->get($key, $default);
        }

        $request->attributes->set($configuration->getName(), $object);

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function supports(ParamConverter $configuration): bool
    {
        return null !== $configuration->getClass() && 'esky.request_query' === $configuration->getConverter();
    }
}
