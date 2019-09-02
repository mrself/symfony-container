<?php declare(strict_types=1);

namespace Mrself\SFContainer\Tests;

use Mrself\SFContainer\SymfonyContainer;
use Mrself\SFContainer\Tests\Mocks\SymfonyContainer as TestSymfonyContainer;
use PHPUnit\Framework\TestCase;

class GetTest extends TestCase
{
    public function testInternalGetIsUsedIfItHasRequestedItem()
    {
        $container = SymfonyContainer::make();
        $container->set('service', 'value');
        $this->assertEquals('value', $container->get('service'));
    }

    public function testSymfonyGetIsUsedIfItHasNotRequestedItem()
    {
        $container = SymfonyContainer::make();
        $sfContainer = new TestSymfonyContainer();
        $container->setSymfonyContainer($sfContainer);
        $sfContainer->services['service'] = 'value';
        $this->assertEquals('value', $container->get('service'));
    }

    public function testCanGetDoctrineEntityManager()
    {
        $container = SymfonyContainer::make();
        $sfContainer = new TestSymfonyContainer();
        $container->setSymfonyContainer($sfContainer);
        $this->assertIsObject($container->get('doctrine.orm.entity_manager'));
    }
}