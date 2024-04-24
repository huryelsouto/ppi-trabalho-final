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
$dataContrato = $_POST['dataContrato'];
$salario = $_POST['salario'];
$senha = $_POST['password'];

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

    // Insere os dados na tabela Funcionario correlacionando com a tabela Pessoa
    $stmt = $pdo->prepare("INSERT INTO Funcionario (DataContrato, Salario, SenhaHash, Codigo) VALUES (:dataContrato, :salario, :senhaHash, :codigo)");
    $stmt->bindParam(':dataContrato', $dataContrato);
    $stmt->bindParam(':salario', $salario);
    $stmt->bindParam(':senhaHash', $hashsenha);
    $stmt->bindParam(':codigo', $lastId);
    $stmt->execute();

    // Confirma a transação
    $pdo->commit();

    echo "Funcionário cadastrado com sucesso!";
} catch(PDOException $e) {
    // Caso ocorra algum erro, cancela a transação
    $pdo->rollBack();
    echo "Erro ao cadastrar funcionário: " . $e->getMessage();
}
?>
