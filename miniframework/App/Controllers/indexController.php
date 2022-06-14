<?php
    namespace App\Controllers;
    use MF\Controller\Action;
    use App\Connection;
    use App\Models\Produto;

    class indexController extends Action {

        public function index()
        {
            //instancia de conexao
            $conn = Connection::getDb();

            //instanciar modelo
            $produto = new Produto($conn);


            $produtos = $produto->getProdutos();

            $this->view->dados = $produtos;
           
            //chamada das views
            //require_once "..\App\Views\index\index.phtml";
            $this->render('index', 'layout1');
        }

        public function sobreNos()
        {
           $this->render('sobrenos', 'layout1');
        }


    }

?>