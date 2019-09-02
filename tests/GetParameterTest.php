<?php declare(strict_types=1);

namespace Mrself\SFContainer\Tests;

use Mrself\SFContainer\SymfonyContainer;
use Mrself\SFContainer\Tests\Mocks\SymfonyContainer as TestSymfonyContainer;
use PHPUnit\Framework\TestCase;

class GetParameterTest extends TestCase
{
    public function testInternalGetIsUsedIfItHasRequestedItem()
    {
        $container = SymfonyContainer::make();
        $container->setParameter('param', 'value');
        $this->assertEquals('value', $container->getParameter('param'));
    }

    public function testSymfonyGetIsUsedIfItHasNotRequestedItem()
    {
        $container = SymfonyContainer::make();
        $sfContainer = new TestSymfonyContainer();
        $container->setSymfonyContainer($sfContainer);
        $sfContainer->parameters['param'] = 'value';
        $this->assertEquals('value', $container->getParameter('param'));
    }
}