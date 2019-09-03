<?php declare(strict_types=1);

namespace Mrself\SFContainer;

use Mrself\Container\Registry\ContainerRegistry;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class SFContainerBundle extends Bundle
{
    /**
     * @throws \Mrself\Container\Registry\InvalidContainerException
     * @throws \Mrself\Container\Registry\NotFoundException
     * @throws \Mrself\Container\Registry\OverwritingException
     */
    public function boot()
    {
        if (ContainerRegistry::has('App')) {
            return;
        }

        $symfonyContainer = $this->container;
        $appContainer = SymfonyContainer::make();
        $appContainer->setSymfonyContainer($symfonyContainer);
        ContainerRegistry::add('App', $appContainer);
    }
}