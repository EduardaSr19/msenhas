<?php
require 'conexao.php';

$servico = $_POST['nome'] ?? '';

if (!$servico) {
    die("Nome do serviço não informado.");
}

$stmt = $pdo->prepare("INSERT INTO servicos (nome) VALUES (?)");
$stmt->execute([$servico]);

echo "Serviço '$servico' cadastrado com sucesso.";
