<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Infra\EntityManagerCreator;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ExcluirCurso implements  RequestHandlerInterface
{
    /**
     * @var \Doctrine\ORM\EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface  $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $idCurso= filter_var(
          $request->getQueryParams()['id'],
          FILTER_VALIDATE_INT
        );

        if(!is_null($idCurso) && $idCurso != false){
            $curso =$this->entityManager->getReference(Curso::class,$idCurso);
            $this->entityManager->remove($curso);
            $this->entityManager->flush();
        }

        return new Response(200, ['location' => '/listar-cursos']);
    }
}