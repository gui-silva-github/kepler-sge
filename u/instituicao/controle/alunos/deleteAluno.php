<?php

    require '../../../../vendor/autoload.php';
    require '../../../../php/SessionManager.php';

    use Kepler\DAO\AlunoDAO;
    use Kepler\Utils\ConexaoDB;

    $conexao = ConexaoDB::getConnection();
    $alunoDAO = new AlunoDAO($conexao);

    $id = filter_input(INPUT_POST, 'alunoId');

    $alunoDAO->deleteAluno($id);

    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;

?>