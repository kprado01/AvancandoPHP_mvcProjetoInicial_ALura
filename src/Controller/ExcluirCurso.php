<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Infra\EntityManagerCreator;

class ExcluirCurso implements  ControllerRequisicaoInterface
{
    /**
     * @var \Doctrine\ORM\EntityManagerInterface
     */
    private $entityManager;

    public function __construct()
    {
        $this->entityManager = (new EntityManagerCreator())->getEntityManager();
    }


    public function processaRequisicao(): void
    {
        $idCurso = filter_input(
            INPUT_GET,
            'id',
            FILTER_VALIDATE_INT
        );

        if(!is_null($idCurso) && $idCurso != false){
            $curso =$this->entityManager->getReference(Curso::class,$idCurso);
            $this->entityManager->remove($curso);
            $this->entityManager->flush();
        }

        header('location: /listar-cursos');

    }
}