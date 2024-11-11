<?php

    require '../../../../vendor/autoload.php';
    require '../../../../php/SessionManager.php';

    use Kepler\DAO\DisciplinaDAO;
    use Kepler\Utils\ConexaoDB;

    $conexao = ConexaoDB::getConnection();
    $disciplinaDAO = new DisciplinaDAO($conexao);

    $id = filter_input(INPUT_POST, 'disciplinaId');

    $disciplinaDAO->deleteDisciplina($id);

    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;

?>