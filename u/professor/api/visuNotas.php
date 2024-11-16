<?php
require '../../../vendor/autoload.php';
require '../../../php/SessionManager.php';

use Kepler\Utils\ConexaoDB;
use Kepler\DAO\NotaDAO;

$conn = ConexaoDB::getConnection();
$notaDao = new NotaDAO($conn);

$notas = $notaDao->getNotasAndAlunoByidClass($_GET["disc"]);

header('Content-type: application/json');
echo json_encode($notas);

$conn = null;
?>