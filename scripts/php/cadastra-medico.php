<?php
require "../../database/conexaoMysql.php";
$pdo = mysqlConnect();


$especialidade = $_POST['especialidade'];
$crm = $_POST['crm'];
$crm = $_POST['codigo'];

try {
    $pdo->beginTransaction();

    $stmt = $pdo->prepare("INSERT INTO Medico (Especialidade, CRM, Codigo) VALUES (:especialidade, :crm, :codigo)");

    $stmt->bindParam(':especialidade', $especialidade);
    $stmt->bindParam(':crm', $crm);
    $stmt->bindParam(':codigo', $codigo);

    $stmt->execute();
    $pdo->commit();

    echo "Funcionário cadastrado com sucesso!";
} catch (PDOException $e) {
    // Caso ocorra algum erro, cancela a transação
    $pdo->rollBack();
    echo "Erro ao cadastrar funcionário: " . $e->getMessage();
}
?>