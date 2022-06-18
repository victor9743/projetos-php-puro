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

    private function validaautenticacao () {
        session_start();
        // pegando variaveis da super global de sessao $_SESSION
        if ((!isset($_SESSION['id']) || $_SESSION['id'] == '') || (!isset($_SESSION['nome']) || $_SESSION['id'] == '')) header('Location: /?login=erro');
    }
}

?>