<?php

use Alura\Cursos\Infra\EntityManagerCreator;
use DI\ContainerBuilder;
use Doctrine\ORM\EntityManagerInterface;

$builder = new ContainerBuilder();
$builder->addDefinitions([
    EntityManagerInterface::class => function () {
        return (new EntityManagerCreator())
            ->getEntityManager();
    }
]);

$container = $builder->build();

return $container;