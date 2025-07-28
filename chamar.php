<?php
session_start();
require 'conexao.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id']) || !isset($_SESSION['guiche'])) {
    header("Location: login.php");
    exit;
}

$usuario_id = $_SESSION['usuario_id'];
$guiche = $_SESSION['guiche'];

// 1. Busca a próxima senha da fila (aguardando), priorizando preferencial
$stmt = $pdo->prepare("
    SELECT s.*
    FROM senhas s
    INNER JOIN tipos_atendimento t ON s.tipo_atendimento_id = t.id
    WHERE s.status = 'aguardando'
    ORDER BY t.prefixo = 'P' DESC, s.id ASC
    LIMIT 1
");
$stmt->execute();
$proximaSenha = $stmt->fetch(PDO::FETCH_ASSOC);

// 2. Verifica se achou uma senha
if ($proximaSenha) {
    // 3. Atualiza a senha para "chamada"
    $stmt = $pdo->prepare("UPDATE senhas SET 
        status = 'chamada',
        data_hora_chamada = NOW(),
        atendente_id = ?,
        guiche_usado = ?
        WHERE id = ?");
    $stmt->execute([$usuario_id, $guiche, $proximaSenha['id']]);

    // 4. Redireciona para o painel
    header("Location: painel_atendente.php");
    exit;
} else {
    // Nenhuma senha aguardando
    $_SESSION['erro'] = "Nenhuma senha disponível na fila.";
    header("Location: painel_atendente.php");
    exit;
}
