<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Usuario;
use Alura\Cursos\Helper\FlashMessageTrait;
use Alura\Cursos\Infra\EntityManagerCreator;

class RealizaLogin implements  ControllerRequisicaoInterface
{

    use FlashMessageTrait;

    /**
     * @var \Doctrine\Common\Persistence\ObjectRepository
     */
    private $repositorioUsuario;

    public function __construct()
    {
        $this->repositorioUsuario = (new EntityManagerCreator())
            ->getEntityManager()
            ->getRepository(Usuario::class);
    }

    public function processaRequisicao(): void
    {
        $email = filter_input(INPUT_POST,
        'email',
        FILTER_VALIDATE_EMAIL
        );

        if(is_null($email) || $email === false){
            $this->defineMensagem( 'danger',
            "O e-mail digitado não é um e-mail válido.");
            header('location: /login');
            return;
        }

        $senha = filter_input(INPUT_POST,
            'senha',
            FILTER_SANITIZE_STRING
        );

        if(is_null($senha) || $senha === false){
            $this->defineMensagem('danger',
            "A senha digitada não é uma senha valida!");
            header('location: /login');
            return;
        }

        /** @var  Usuario $usuario */
         $usuario = $this->repositorioUsuario->findOneBy(['email' => $email]);

         if(is_null($usuario) || !$usuario->senhaEstaCorreta($senha)){
             $this->defineMensagem('danger',
              'Senha ou Email incorretos');
             header('location: /login');
             return;
         }

         $_SESSION['logado'] = true;
         header('location: /listar-cursos');

    }
}