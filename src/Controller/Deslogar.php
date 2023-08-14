<?php

namespace Alura\Cursos\Controller;

use Symfony\Component\Console\Output\ConsoleOutputInterface;

class Deslogar implements ControllerRequisicaoInterface
{
    public function processaRequisicao(): void
    {
        session_destroy();
        header('Location: /login');
    }
}