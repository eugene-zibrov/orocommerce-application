<?php

namespace Training\Bundle\UserNamingBundle\Api\Processor\GetList;

use Oro\Component\ChainProcessor\ContextInterface;
use Oro\Component\ChainProcessor\ProcessorInterface;
use Training\Bundle\UserNamingBundle\Service\TrainingNamingConverterExample;

class AddExampleFieldToUserNaming implements ProcessorInterface
{
    public function __construct(private TrainingNamingConverterExample $exampleConverter)
    {
    }

    public function process(ContextInterface $context)
    {
        $results = $context->getResult();
        foreach ($results as $key => $result) {
            $format                   = $result['format'];
            $results[$key]['example'] = $this->exampleConverter->getExample($format);
        }

        $context->setResult($results);
    }
}
