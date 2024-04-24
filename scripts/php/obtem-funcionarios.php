<?php
require "../../database/conexaoMysql.php";
$pdo = mysqlConnect();

$funcionarios = [];

try {
    
    // Prepara a query SQL para selecionar os dados dos funcionários
    $stmt = $pdo->prepare("SELECT Pessoa.Nome, Pessoa.Email, Pessoa.Sexo, Pessoa.Telefone, Funcionario.Salario, Funcionario.Codigo FROM Pessoa INNER JOIN Funcionario ON Pessoa.Codigo = Funcionario.Codigo");

    // Executa a query SQL
    $stmt->execute();

    // Obtém os dados dos funcionários
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Adiciona os dados de cada funcionário ao array
        $funcionarios[] = $row;
    }

    // Retorna os dados dos funcionários em formato JSON
    echo json_encode($funcionarios);
} catch(PDOException $e) {
    // Em caso de erro, exibe a mensagem de erro
    echo "Erro ao obter os dados dos funcionários: " . $e->getMessage();
}

// Fecha a conexão com o banco de dados
$pdo = null;
?>
