<?php declare(strict_types=1);

namespace Mrself\SFContainer;

use Doctrine\DBAL\Connection;
use Mrself\Container\Container as BaseContainer;
use Symfony\Component\DependencyInjection\ContainerInterface;

class SymfonyContainer extends BaseContainer
{
    /**
     * @var ContainerInterface
     */
    protected $symfonyContainer;

    public function get(string $key, $default = false)
    {
        if ($this->has($key)) {
            return $this->internalGet($key);
        }

        return $this->symfonyContainer->get($key);
    }

    /**
     * @param ContainerInterface $container
     * @throws \Mrself\Container\Registry\NotFoundException
     */
    public function setSymfonyContainer(ContainerInterface $container)
    {
        $this->symfonyContainer = $container;
        $em = $container->get('doctrine.orm.entity_manager');
        $this->set('Doctrine\\ORM\\EntityManager', $em);
        $this->set(Connection::class, $em->getConnection());
        $this->set('Doctrine\\Bundle\\DoctrineBundle\\Registry', $container->get('doctrine'));
    }

    public function getParameter(string $key, $default = false)
    {
        if ($this->hasParameter($key)) {
            return parent::getParameter($key);
        }

        return $this->symfonyContainer->getParameter($key);
    }
}