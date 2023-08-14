<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Helper\RenderizaHtml;
use Alura\Cursos\Infra\EntityManagerCreator;

class ListaCursos  implements ControllerRequisicaoInterface
{
    use RenderizaHtml;

    private $repositorioCursos;

    public function __construct()
    {
        $entityManager = (new EntityManagerCreator())->getEntityManager();
        $this->repositorioDeCursos = $entityManager->getRepository(Curso::class);
    }

    public function processaRequisicao() : void
    {
        $cursos = $this->repositorioDeCursos->findAll();
        echo $this->renderizaHtml('cursos/listar-cursos.php',[
            'cursos' => $cursos,
            'titulo' => 'Listar Cursos'
        ]);
    }
}