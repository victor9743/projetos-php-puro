<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class authController extends Action {

    public function autenticar() {
        $usuario = Container::getModel('Usuario');

        $usuario->__set('email', $_POST['email']);
        $usuario->__set('senha', md5($_POST['senha']));

        $usuario->autenticar();

        if ($usuario->__get('id') != '' && $usuario->__get('nome')) {

            session_start();

            $_SESSION['id'] = $usuario->__get('id');
            $_SESSION['nome'] = $usuario->__get('nome');

            header('Location: /timeline');

        } else {
            // redireciona o a aplicacao para o diretotio raiz
            header('Location: /?login=erro');
        }
        
    }

    public function sair(){
        session_start();

        // destroy a sessao
        session_destroy();
        header('Location: /');
    }

}


?>