<?php
    namespace App\Controllers;

    use MF\Controller\Action;
    use MF\Model\Container;

    use App\Models\Produto;
    use App\Models\Info;

    class indexController extends Action {

        public function index()
        {
            //instancia de conexao
            $produto =  Container::getModel('produto');
            //instanciar modelo


            $produtos = $produto->getProdutos();

            $this->view->dados = $produtos;
           
            //chamada das views
            //require_once "..\App\Views\index\index.phtml";
            $this->render('index', 'layout1');
        }

        public function sobreNos()
        {
            //instancia de conexao
            $info = Container::getModel('info');

            //instanciar modelo
            $infos = $info->getInfo();

            $this->view->dados = $infos;
            $this->render('sobrenos', 'layout1');
        }


    }

?>