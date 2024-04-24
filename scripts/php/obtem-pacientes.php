<?php
require "../../database/conexaoMysql.php";
$pdo = mysqlConnect();

$pacientes = [];

try {
    
    // Prepara a query SQL para selecionar os dados dos pacientes
    $stmt = $pdo->prepare("SELECT Pessoa.Nome, Pessoa.Email, Pessoa.Sexo, Pessoa.Telefone, Paciente.Peso, Paciente.Altura, Paciente.TipoSanguineo, Paciente.Codigo FROM Pessoa INNER JOIN Paciente ON Pessoa.Codigo = Paciente.Codigo");

    // Executa a query SQL
    $stmt->execute();

    // Obtém os dados dos pacientes
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Adiciona os dados de cada funcionário ao array
        $pacientes[] = $row;
    }

    // Retorna os dados dos pacientes em formato JSON
    echo json_encode($pacientes);
} catch(PDOException $e) {
    // Em caso de erro, exibe a mensagem de erro
    echo "Erro ao obter os dados dos pacientes: " . $e->getMessage();
}

// Fecha a conexão com o banco de dados
$pdo = null;
?>
