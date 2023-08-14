<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Usuario;
use Alura\Cursos\Helper\FlashMessageTrait;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class RealizaLogin implements  RequestHandlerInterface
{

    use FlashMessageTrait;

    /**
     * @var \Doctrine\Common\Persistence\ObjectRepository
     */
    private $repositorioUsuario;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repositorioUsuario = $entityManager->getRepository(Usuario::class);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {

        $email = filter_var($request->getParsedBody()['email'],
        FILTER_VALIDATE_EMAIL);

        if(is_null($email) || $email === false){
            $this->defineMensagem( 'danger',
                "O e-mail digitado não é um e-mail válido.");
            header('location: /login');
            return new Response(400, ['location' => '/login']);
        }

        $senha = filter_var(
            $request->getParsedBody()['senha'],
            FILTER_SANITIZE_STRING
        );

        if(is_null($senha) || $senha === false){
            $this->defineMensagem('danger',
                "A senha digitada não é uma senha valida!");
            return new Response(400, ['location' => '/login']);
        }

        /** @var  Usuario $usuario */
        $usuario = $this->repositorioUsuario->findOneBy(['email' => $email]);

        if(is_null($usuario) || !$usuario->senhaEstaCorreta($senha)){
            $this->defineMensagem('danger',
                'Senha ou Email incorretos');

            return new Response(400, ['location' => '/login']);
        }

        $_SESSION['logado'] = true;

        return new Response(200, ['location' =>'/listar-cursos']);
    }
}