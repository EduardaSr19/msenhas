<?php
session_start();
require 'conexao.php';

// Verifica se está logado e se foi passado o ID da senha
if (!isset($_SESSION['usuario_id']) || !isset($_GET['id'])) {
    header("Location: login.php");
    exit;
}

$senha_id = $_GET['id'];

// Atualiza a senha para "em_atendimento"
$stmt = $pdo->prepare("UPDATE senhas SET 
    status = 'em_atendimento', 
    data_hora_inicio = NOW()
    WHERE id = ?");
$stmt->execute([$senha_id]);

header("Location: painel_atendente.php");
exit;
