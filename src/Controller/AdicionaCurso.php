<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Helper\RenderizaHtml;

class AdicionaCurso  implements  ControllerRequisicaoInterface
{
    use RenderizaHtml;

    public function processaRequisicao() : void
    {
        echo $this->renderizaHtml('cursos/adicionar-curso.php', [
            'titulo' => 'Novo Curso'
        ]);

    }
}