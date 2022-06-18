<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class appController extends Action {
    public function timeline () {

        session_start();
        // pegando variaveis da super global de sessao $_SESSION
        if (isset($_SESSION['id']) && isset($_SESSION['nome'])) {
            $this->render('timeline');
        } else {
            header('Location: /?login=erro');
        }

        
        
    }
}

?>