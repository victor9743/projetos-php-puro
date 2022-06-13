<?php
    namespace App\Controllers;

    class indexController {

        public function index(){

            $dados = array("1", "2", "3");

            //chamada das views
            require_once "..\App\Views\index\index.phtml";
        }

        public function sobreNos(){
            require_once "..\App\Views\index\sobrenos.phtml";
        }
    }

?>