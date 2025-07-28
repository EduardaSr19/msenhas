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

// Busca a próxima senha da fila (prioridade: preferencial > comum)
$stmt = $pdo->prepare("UPDATE senhas SET 
    status = 'chamada',
    data_hora_chamada = NOW(),
    atendente_id = ?,
    guiche_usado = ?
    WHERE id = ?");
$stmt->execute([$usuario_id, $guiche, $proximaSenha['id']]);

$proximaSenha = $stmt->fetch(PDO::FETCH_ASSOC);

if ($proximaSenha) {
    // Atualiza a senha como chamada
    $stmt = $pdo->prepare("UPDATE senhas SET 
        status = 'chamada',
        data_hora_chamada = NOW(),
        atendente_id = ?
        WHERE id = ?");
    $stmt->execute([$usuario_id, $proximaSenha['id']]);

    // (Opcional: salvar o guichê em um campo separado, se quiser histórico)

    // Enviar para o telão — aqui pode ser com WebSocket/Pusher futuramente

    // Redireciona de volta para o painel
    header("Location: painel_atendente.php");
    exit;
} else {
    // Nenhuma senha disponível
    $_SESSION['erro'] = "Nenhuma senha disponível na fila.";
    header("Location: painel_atendente.php");
    exit;
}
