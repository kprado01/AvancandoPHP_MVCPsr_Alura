<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Helper\RenderizaHtml;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class AdicionaCurso  implements  RequestHandlerInterface
{
    use RenderizaHtml;

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
         return new Response(200, [], $this->renderizaHtml('cursos/adicionar-curso.php', [
            'titulo' => 'Novo Curso'
        ]));
    }
}