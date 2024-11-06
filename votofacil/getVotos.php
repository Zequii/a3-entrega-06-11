<?php
header('Content-Type: application/json');

// Conectar ao banco de dados
$host = 'localhost';
$dbname = 'sistema_votacao';
$user = 'usuario';
$password = 'senha';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta SQL para obter nome e votos dos candidatos
    $sql = "SELECT nome, votos FROM candidatos";
    $query = $pdo->prepare($sql);
    $query->execute();

    // Pega os dados como array associativo
    $resultados = $query->fetchAll(PDO::FETCH_ASSOC);

    // Retorna os dados em formato JSON
    echo json_encode($resultados);

} catch (PDOException $e) {
    echo json_encode(['error' => 'Erro na conexão com o banco de dados']);
}
?>
