<?php

    require '../../../../vendor/autoload.php';
    require '../../../../php/SessionManager.php';

use Kepler\DAO\TurmaDAO;
use Kepler\Utils\ConexaoDB;

    $conexao = ConexaoDB::getConnection();
    $turmaDAO = new TurmaDAO($conexao);

    $id = filter_input(INPUT_POST, 'turmaId');

    $turmaDAO->deleteTurma($id);

    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;

?>