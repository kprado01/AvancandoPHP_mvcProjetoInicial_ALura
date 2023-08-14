<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Helper\RenderizaHtml;

class Login  implements  ControllerRequisicaoInterface
{
    use RenderizaHtml;

    public function processaRequisicao(): void
    {
        echo $this->renderizaHtml('/login/login.php',[
            'titulo' => 'Login'
            ]);
    }
}