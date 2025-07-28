<?php
require 'conexao.php';
date_default_timezone_set('America/Sao_Paulo');

// Recebe os dados do formulário
$tipo_id = $_POST['tipo_id'] ?? null;
$servico_id = $_POST['servico_id'] ?? null;

if (!$tipo_id || !$servico_id) {
    die("Dados inválidos.");
}

// Busca o prefixo do tipo de atendimento (ex: A, P)
$stmt = $pdo->prepare("SELECT prefixo FROM tipos_atendimento WHERE id = ?");
$stmt->execute([$tipo_id]);
$tipo = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$tipo) {
    die("Tipo de atendimento não encontrado.");
}

$prefixo = $tipo['prefixo'];

// Verifica o último número emitido hoje com esse prefixo
$dataHoje = date('Y-m-d') . " 00:00:00";
$stmt = $pdo->prepare("SELECT codigo FROM senhas 
    WHERE tipo_atendimento_id = ? 
    AND data_hora_emissao >= ?
    ORDER BY id DESC LIMIT 1");
$stmt->execute([$tipo_id, $dataHoje]);
$ultimaSenha = $stmt->fetch(PDO::FETCH_ASSOC);

if ($ultimaSenha) {
    // Extrai o número (ex: A012 → 12)
    $ultimoNumero = intval(substr($ultimaSenha['codigo'], 1));
    $novoNumero = $ultimoNumero + 1;
} else {
    $novoNumero = 1;
}

// Formata com 3 dígitos, exemplo: A001
$codigo = $prefixo . str_pad($novoNumero, 3, "0", STR_PAD_LEFT);

// Insere a nova senha no banco
$stmt = $pdo->prepare("INSERT INTO senhas 
    (codigo, tipo_atendimento_id, servico_id, status) 
    VALUES (?, ?, ?, 'aguardando')");
$stmt->execute([$codigo, $tipo_id, $servico_id]);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Senha Emitida</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { text-align: center; padding: 60px; font-size: 24px; }
    .senha { font-size: 80px; font-weight: bold; margin: 40px 0; }
  </style>
</head>
<body>
  <h1>Sua senha foi gerada!</h1>
  <div class="senha"><?= $codigo ?></div>
  <p>Aguarde ser chamado no painel.</p>
  <a href="emite.php" class="btn btn-secondary mt-4">Voltar</a>
</body>
</html>
