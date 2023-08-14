<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Helper\RenderizaHtml;
use Alura\Cursos\Infra\EntityManagerCreator;


class EditarCurso  implements  ControllerRequisicaoInterface
{
    use RenderizaHtml;

    /**
     * @var \Doctrine\Common\Persistence\ObjectRepository
     */
    private $repositorioCursos;

    public function __construct()
    {
        $entityManager = (new EntityManagerCreator())->getEntityManager();
        $this->repositorioCursos = $entityManager->getRepository(Curso::class);
    }

    public function processaRequisicao(): void
    {
        $idCurso = filter_input(
            INPUT_GET,
            'id',
            FILTER_VALIDATE_INT
        );

        if(is_null($idCurso) || $idCurso == false){
            header('location: /listar-cursos');
            return;
        }
        /**
         * @var  Curso $curso
         */
        $curso = $this->repositorioCursos->find($idCurso);

        echo $this->renderizaHtml('cursos/adicionar-curso.php',[
           'titulo' => "Atualizar curso: {$curso->getDescricao()}",
            'curso' => $curso,
        ]);
    }
}