<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Helper\FlashMessageTrait;
use Alura\Cursos\Infra\EntityManagerCreator;

class SalvarCurso implements  ControllerRequisicaoInterface
{
    use FlashMessageTrait;
    /**
     * @var EntityManagerCreator
     */
    private $entityManager;

    public function __construct()
    {
        $this->entityManager = (new EntityManagerCreator())->getEntityManager();
    }

    public function processaRequisicao(): void
    {
        $descricao = filter_input(
            INPUT_POST,
            'descricao',
            FILTER_SANITIZE_STRING
        );

        $idCurso = filter_input(
            INPUT_GET,
            'id',
            FILTER_VALIDATE_INT
        );

        $curso = new Curso();
        $curso->setDescricao($descricao);

        if(!is_null($idCurso) && $idCurso != false){
            $curso->setId($idCurso);
            $this->entityManager->merge($curso);
            $mensagem = 'Curso atualizado com sucesso';
        }
        else{
            $this->entityManager->persist($curso);
            $mensagem = 'Curso atualizado com sucesso';
        }

        $this->entityManager->flush();
        $this->defineMensagem('success', $mensagem);
        header('location: /listar-cursos', true, 302);
    }
}