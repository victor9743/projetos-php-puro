<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class appController extends Action {
    public function timeline () {
  
        $this->validaautenticacao();
        //recuperacao dos tweets
        $tweet = Container::getModel('Tweet');
        
        $tweet->__set('id_usuario', $_SESSION['id']);
        
        $tweets = $tweet->getAll();

        $this->view->tweets = $tweets;
        
        $this->render('timeline');
     
    }

    public function tweet() {

        $this->validaautenticacao();

        $tweet = Container::getModel('Tweet');
        
        $tweet->__set('tweet', $_POST['tweet']);
        $tweet->__set('id_usuario', $_SESSION['id']);
        $tweet->salvar();

        header('Location: /timeline');

    }

    public function quemSeguir() {
        $this->validaautenticacao();
        $pesquisarPor = isset($_GET['pesquisarPor']) ? $_GET['pesquisarPor'] : '';
        $usuarios = array();

        if ($pesquisarPor != '') {
            $usuario = Container::getModel('Usuario');
            $usuario->__set('nome', $pesquisarPor);
            $usuario->__set('id', $_SESSION['id']);
            $usuarios = $usuario->getAll();

        }
        
        $this->view->usuarios = $usuarios;
        $this->render('quemSeguir');
    }

    public function acao() {
        $this->validaautenticacao();

        $acao = isset($_GET['acao']) ? $_GET['acao'] : '';
        $id_usuario_seguindo = isset($_GET['id_usuario']) ? $_GET['id_usuario'] : '';

        $usuario = Container::getModel('Usuario');
        $usuario->__set('id', $_SESSION['id']);

        if($acao =='seguir') {
            $usuario->seguirUsuario($id_usuario_seguindo);
        } else {
            $usuario->deixarSeguirUsuario($id_usuario_seguindo);
        }

        header('Location: /quem_seguir');

    }

    private function validaautenticacao () {
        session_start();
        // pegando variaveis da super global de sessao $_SESSION
        if ((!isset($_SESSION['id']) || $_SESSION['id'] == '') || (!isset($_SESSION['nome']) || $_SESSION['id'] == '')) header('Location: /?login=erro');
    }
}

?>