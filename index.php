<?php 
    require 'vendor/autoload.php';
    
    use Html\Mvc\Controller\Controller;
    use Html\Mvc\Core\Core;

    $mvc = new Core($_GET['route'] ?? '/'); //Primeiro argumento pega a requisição segundo o Controller
    $mvc->paginas('/produto', Controller::class);
    $mvc->index('/', Controller::class);
    $mvc->dispararRotas('erro', Controller::class);

    //$mvc->Routes('/ss/{variavel}', ['paginass']); //Página com argumentos