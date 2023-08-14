<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ListaCursosJson implements  RequestHandlerInterface
{

    public function __construct(EntityManagerInterface  $entityManager)
    {
        $this->repositorioCursos = $entityManager->getRepository(Curso::class);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $listadeCursos = $this->repositorioCursos->findAll();
        return new Response(200, ['Content-Type' => 'application/json'], json_encode($listadeCursos));
    }
}