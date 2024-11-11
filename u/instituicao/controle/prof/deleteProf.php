<?php

    require '../../../../vendor/autoload.php';
    require '../../../../php/SessionManager.php';

    use Kepler\DAO\ProfDAO;
    use Kepler\Utils\ConexaoDB;

    $conexao = ConexaoDB::getConnection();
    $profDAO = new ProfDAO($conexao);

    $id = filter_input(INPUT_POST, 'profId');

    $profDAO->deleteProf($id);

    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;

?>