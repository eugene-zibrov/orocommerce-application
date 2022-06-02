<?php

namespace Training\Bundle\UserNamingBundle\Api\Processor\Get;

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
        $result = $context->getResult();
        $format = $result['format'];
        $result['example'] = $this->exampleConverter->getExample($format);
        $context->setResult($result);
    }
}

