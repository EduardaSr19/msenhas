<?php
session_start();
require 'conexao.php';

$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';
$guiche = $_POST['guiche'] ?? '';

$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ? LIMIT 1");
$stmt->execute([$email]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario || !password_verify($senha, $usuario['senha'])) {
    $_SESSION['erro'] = "E-mail ou senha inválidos!";
    header("Location: login.php");
    exit;
}

// Armazena dados na sessão
$_SESSION['usuario_id'] = $usuario['id'];
$_SESSION['usuario_nome'] = $usuario['nome'];
$_SESSION['perfil'] = $usuario['perfil']; // <- AQUI
$_SESSION['guiche'] = $guiche;

// Redireciona para painel correspondente
if ($usuario['perfil'] === 'admin') {
    header("Location: painel_admin.php");
} else {
    header("Location: painel_atendente.php");
}
exit;
