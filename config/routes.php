<?php

use Alura\Cursos\Controller\AdicionaCurso;
use Alura\Cursos\Controller\Deslogar;
use Alura\Cursos\Controller\EditarCurso;
use Alura\Cursos\Controller\ExcluirCurso;
use Alura\Cursos\Controller\ListaCursos;
use Alura\Cursos\Controller\ListaCursosJson;
use Alura\Cursos\Controller\ListaCursosXML;
use Alura\Cursos\Controller\Login;
use Alura\Cursos\Controller\RealizaLogin;
use Alura\Cursos\Controller\SalvarCurso;

return [
    '/listar-cursos' => ListaCursos::class,
    '/novo-curso' => AdicionaCurso::class,
    '/salvarCurso' => SalvarCurso::class,
    '/excluir-curso' => ExcluirCurso::class,
    '/editar-curso' => EditarCurso::class,
    '/login' => Login::class,
    '/realiza-login' => RealizaLogin::class,
    '/logout' => Deslogar::class,
    '/cursos-json' => ListaCursosJson::class,
    '/cursos-xml' => ListaCursosXML::class

];