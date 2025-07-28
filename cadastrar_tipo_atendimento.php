<?php
require 'conexao.php';

$nome = $_POST['nome'] ?? '';
$prefixo = strtoupper(trim($_POST['prefixo'] ?? ''));

if (!$nome || !$prefixo || strlen($prefixo) !== 1) {
    die("Dados inválidos.");
}

try {
    $stmt = $pdo->prepare("INSERT INTO tipos_atendimento (nome, prefixo) VALUES (?, ?)");
    $stmt->execute([$nome, $prefixo]);
    $mensagem = "Tipo de atendimento '$nome' com prefixo '$prefixo' cadastrado com sucesso.";
} catch (Exception $e) {
    $mensagem = "Erro ao cadastrar: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Resultado do Cadastro</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-5">
  <div class="alert alert-info">
    <?= $mensagem ?>
  </div>
  <a href="form_tipo_atendimento.php" class="btn btn-primary">Cadastrar outro</a>
  <a href="emite.php" class="btn btn-secondary ms-2">Ir para Totem</a>
</body>
</html>
