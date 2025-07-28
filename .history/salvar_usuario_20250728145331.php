<?php
require 'conexao.php';

$nome = $_POST['nome'] ?? '';
$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';
$perfil = $_POST['perfil'] ?? '';

if (!$nome || !$email || !$senha || !$perfil) {
    die("Dados incompletos.");
}

$senhaHash = password_hash($senha, PASSWORD_DEFAULT);

try {
    $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha, perfil) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nome, $email, $senhaHash, $perfil]);
    echo "Usuário cadastrado com sucesso!";
} catch (Exception $e) {
    echo "Erro ao cadastrar: " . $e->getMessage();
}
