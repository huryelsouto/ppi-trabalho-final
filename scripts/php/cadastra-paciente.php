<?php
require "../../database/conexaoMysql.php";
$pdo = mysqlConnect();

// Recebe os dados do formulário
$name = $_POST['name'];
$sexo = $_POST['sexo'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$cep = $_POST['cep'];
$logradouro = $_POST['logradouro'];
$cidade = $_POST['cidade'];
$estado = $_POST['estado'];
if (isset($_POST['peso']) && isset($_POST['altura']) && isset($_POST['tipoSanguineo'])) {
    $peso = $_POST['peso'];
    $altura = $_POST['altura'];
    $tipoSanguineo = $_POST['tipoSanguineo'];
}

$hashsenha = password_hash($senha, PASSWORD_DEFAULT);


try {
    $pdo->beginTransaction();
    // Insere os dados na tabela Pessoa
    $stmt = $pdo->prepare("INSERT INTO Pessoa (Nome, Sexo, Email, Telefone, CEP, Logradouro, Cidade, Estado) VALUES (:nome, :sexo, :email, :telefone, :cep, :logradouro, :cidade, :estado)");
    $stmt->bindParam(':nome', $name);
    $stmt->bindParam(':sexo', $sexo);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':telefone', $telefone);
    $stmt->bindParam(':cep', $cep);
    $stmt->bindParam(':logradouro', $logradouro);
    $stmt->bindParam(':cidade', $cidade);
    $stmt->bindParam(':estado', $estado);
    $stmt->execute();

    // Obtém o último ID inserido
    $lastId = $pdo->lastInsertId();

    // Insere os dados na tabela Paciente correlacionando com a tabela Pessoa
    $stmt = $pdo->prepare("INSERT INTO Paciente (Peso, Altura, TipoSanguineo, Codigo) VALUES (:peso, :altura, :tipoSanguineo, :codigo)");
    $stmt->bindParam(':peso', $peso);
    $stmt->bindParam(':altura', $altura);
    $stmt->bindParam(':tipoSanguineo', $tipoSanguineo);
    $stmt->bindParam(':codigo', $lastId);

    // Executa a query SQL
    $stmt->execute();

    echo "Paciente cadastrado com sucesso.";

    // Confirma a transação
    $pdo->commit();

    echo "Funcionário cadastrado com sucesso!";
} catch (PDOException $e) {
    // Caso ocorra algum erro, cancela a transação
    $pdo->rollBack();
    echo "Erro ao cadastrar funcionário: " . $e->getMessage();
}
?>