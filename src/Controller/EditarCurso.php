<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Helper\FlashMessageTrait;
use Alura\Cursos\Helper\RenderizaHtml;
use Alura\Cursos\Infra\EntityManagerCreator;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;


class EditarCurso  implements  RequestHandlerInterface
{
    use RenderizaHtml;
    use FlashMessageTrait;

    /**
     * @var \Doctrine\Common\Persistence\ObjectRepository
     */
    private $repositorioCursos;

    public function __construct(EntityManagerInterface  $entityManager)
    {
        $this->repositorioCursos = $entityManager->getRepository(Curso::class);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $idCurso = filter_var(
            $request->getQueryParams()['id'],
            FILTER_VALIDATE_INT
        );

        if(is_null($idCurso) || $idCurso == false){
            $this->defineMensagem('danger', 'Curso não existe na base de dados!');
            return new  Response(500, ['location' => '/listar-cursos']);
        }

        /**
         * @var  Curso $curso
         */
        $curso = $this->repositorioCursos->find($idCurso);

        return new Response(200,[], $this->renderizaHtml('cursos/adicionar-curso.php',[
            'titulo' => "Atualizar curso: {$curso->getDescricao()}",
            'curso' => $curso,
        ]));
    }
}