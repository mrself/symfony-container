<?php declare(strict_types=1);

namespace Mrself\SFContainer\Tests\Mocks;

use Symfony\Component\DependencyInjection\ContainerInterface;

class SymfonyContainer implements ContainerInterface
{
    public $services = [];
    public $parameters = [];

    public function __construct()
    {
        $manager = new class {
            public function getConnection()
            {
                return 'connection';
            }
        };

        $this->services = [
            'doctrine.orm.entity_manager' => $manager,
            'doctrine' => 'registry',
        ];
    }

    public function initialized($id)
    {
    }

    public function set($id, $service)
    {
    }

    public function has($id)
    {
    }

    public function getParameter($name)
    {
        return $this->parameters[$name];
    }

    public function hasParameter($name)
    {
    }

    public function setParameter($name, $value)
    {
    }

    public function get($id, $invalidBehavior = self::EXCEPTION_ON_INVALID_REFERENCE)
    {
        return $this->services[$id];
    }
}