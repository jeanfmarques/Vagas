<?php

require __DIR__ . '/vendor/autoload.php';

use \App\Entity\Usuario;
use \App\Session\Login;

//OBRIGA O USUÁRIO A NÃO ESTAR LOGADO
Login::requireLogout();

//VALIDAÇÃO DO POST
if(isset($_POST['acao'])){

    switch($_POST['acao']){
        case 'logar';
        break;

        case 'cadastrar';

        if(isset($_POST['nome'],$_POST['email'],$_POST['senha'])){
         
            $obUsuario = new Usuario;
            $obUsuario->nome = $_POST['nome'];
            $obUsuario->email = $_POST['email'];
            $obUsuario->senha = $_POST['senha'];

            echo "<pre>";
            print_r($obUsuario);
            echo "</pre>"; exit;
        }

        break;
    }

}

include __DIR__ . '/includes/header.php';
include __DIR__ . '/includes/formulario-login.php';
include __DIR__ . '/includes/footer.php';
