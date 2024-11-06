<?php
// Configurações do banco de dados
$host = 'localhost';  // Endereço do servidor do banco de dados
$dbname = 'votacao';  // Nome do banco de dados
$user = 'seu_usuario'; // Usuário do banco de dados
$password = 'sua_senha'; // Senha do banco de dados

// Conectar ao banco de dados
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}

// Verificar se os dados foram enviados pelo formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $idade = $_POST['idade'];
    
    // Validar os dados
    if (!empty($nome) && !empty($email) && !empty($idade)) {
        // Inserir dados na tabela de candidatos
        $sql = "INSERT INTO candidatos (nome, email, idade) VALUES (:nome, :email, :idade)";
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':idade', $idade);
        
        if ($stmt->execute()) {
            echo "Cadastro realizado com sucesso!";
        } else {
            echo "Erro ao cadastrar candidato.";
        }
    } else {
        echo "Preencha todos os campos!";
    }
}
?>
