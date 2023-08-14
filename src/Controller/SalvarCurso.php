<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Helper\FlashMessageTrait;
use Alura\Cursos\Infra\EntityManagerCreator;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class SalvarCurso implements  RequestHandlerInterface
{
    use FlashMessageTrait;
    /**
     * @var EntityManagerCreator
     */
    private $entityManager;

    public function __construct(EntityManagerInterface  $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $descricao = filter_var(
          $request->getParsedBody()['descricao'],
          FILTER_SANITIZE_STRING
        );

        $idCurso = filter_var(
            $request->getQueryParams()['id'],
            FILTER_VALIDATE_INT
        );

        $curso = new Curso();
        $curso->setDescricao($descricao);

        if(!is_null($idCurso) && $idCurso != false){
            $curso->setId($idCurso);
            $this->entityManager->merge($curso);
            $mensagem = 'Curso atualizado com sucesso';
        }
        else{
            $this->entityManager->persist($curso);
            $mensagem = 'Curso atualizado com sucesso';
        }

        $this->entityManager->flush();
        $this->defineMensagem('success', $mensagem);
        return new Response(302, ['location' => '/listar-cursos']);
    }
}