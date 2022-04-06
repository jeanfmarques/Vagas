<?php

use \App\Session\Login;

//DADOS DO USUÁRIO LOGADO
$usuarioLogado = Login::getUsuarioLogado();

//DETALHES DO USUÁRIO
$usuario = $usuarioLogado ?
           $usuarioLogado['nome'].' <a href="logout.php" class="text-light font-weight-bold ml-2">Sair</a>' :
           'Visitante <a href="login.php" class="text-light font-weight-bold ml-2">Entrar</a>';

?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <title>Sistema de Vagas</title>
</head>

<body class="bg-dark text-light">
  <div class="container">
    <div class="jumbotron bg-danger">
      <h1>Sistema de Vagas</h1>
      <p>Sistema em PHP para o cadastro de vagas</p>

      <hr class="border-light">
      <div class="d-flex justify-content-start">
        <?=$usuario?>
      </div>
    </div>