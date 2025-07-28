<?php
session_start();
require 'conexao.php';

// Verifica se o usuário está logado e se foi passado o ID
if (!isset($_SESSION['usuario_id']) || !isset($_GET['id'])) {
    header("Location: login.php");
    exit;
}

$senha_id = $_GET['id'];

// Atualiza a senha para "finalizada"
$stmt = $pdo->prepare("UPDATE senhas SET 
    status = 'finalizada',
    data_hora_fim = NOW()
    WHERE id = ?");
$stmt->execute([$senha_id]);

header("Location: painel_atendente.php");
exit;
