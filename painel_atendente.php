<?php
session_start();
require 'conexao.php';

// Verifica se está logado
if (!isset($_SESSION['usuario_id']) || !isset($_SESSION['guiche'])) {
    header("Location: login.php");
    exit;
}

$nome = $_SESSION['usuario_nome'];
$guiche = $_SESSION['guiche'];

// Pega a senha atual (em atendimento ou chamada)
$stmt = $pdo->prepare("SELECT * FROM senhas 
    WHERE status IN ('chamada', 'em_atendimento') 
    AND atendente_id = ? 
    ORDER BY id DESC LIMIT 1");
$stmt->execute([$_SESSION['usuario_id']]);
$senhaAtual = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Painel da Atendente</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .senha-grande { font-size: 4rem; font-weight: bold; margin: 20px 0; }
  </style>
</head>
<body class="container py-5">

  <h2>Bem-vinda, <?= $nome ?> (Guichê <?= $guiche ?>)</h2>
  <a href="logout.php" class="btn btn-outline-danger btn-sm float-end">Sair</a>

  <hr>

  <?php if ($senhaAtual): ?>
    <div class="text-center">
      <div class="senha-grande"><?= $senhaAtual['codigo'] ?></div>
      <p>Status: <strong><?= strtoupper($senhaAtual['status']) ?></strong></p>

      <?php if ($senhaAtual['status'] === 'chamada'): ?>
        <a href="iniciar.php?id=<?= $senhaAtual['id'] ?>" class="btn btn-success btn-lg">Iniciar Atendimento</a>
      <?php elseif ($senhaAtual['status'] === 'em_atendimento'): ?>
        <a href="finalizar.php?id=<?= $senhaAtual['id'] ?>" class="btn btn-primary btn-lg">Finalizar</a>
      <?php endif; ?>
      <a href="pular.php?id=<?= $senhaAtual['id'] ?>" class="btn btn-warning btn-lg ms-2">Pular</a>
    </div>
  <?php else: ?>
    <div class="text-center">
      <p>Nenhuma senha em atendimento.</p>
      <a href="chamar.php" class="btn btn-primary btn-lg">Chamar Próxima</a>
    </div>
  <?php endif; ?>

</body>
</html>
