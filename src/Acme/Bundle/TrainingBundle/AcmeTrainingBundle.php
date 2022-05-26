<?php

namespace Acme\Bundle\TrainingBundle;

use Acme\Bundle\TrainingBundle\DependencyInjection\AcmeTrainingBundleExtension;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class AcmeTrainingBundle extends Bundle
{
    public function getContainerExtension(): ExtensionInterface
    {
        if (null === $this->extension) {
            $this->extension = new AcmeTrainingBundleExtension();
        }
        return $this->extension;
    }
}
