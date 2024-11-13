<?php

    require '../../../../vendor/autoload.php';
    require '../../../../php/SessionManager.php';

    use Kepler\DAO\MatriculaDAO;
    use Kepler\Utils\ConexaoDB;

    $conexao = ConexaoDB::getConnection();
    $matriculaDAO = new MatriculaDAO($conexao);

    $id = filter_input(INPUT_POST, 'matriculaId');

    $matriculaDAO->deleteMatricula($id);

    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;

?>