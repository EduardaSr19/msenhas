<?php
session_start();
require 'conexao.php';

// Verifica se o usuário é admin
if (!isset($_SESSION['usuario_id']) || $_SESSION['perfil'] !== 'admin') {
    header("Location: login.php");
    exit;
}

// Busca todas as senhas
$stmt = $pdo->query("
    SELECT s.*, 
           t.nome AS tipo_nome, 
           sv.nome AS servico_nome,
           u.nome AS atendente_nome
    FROM senhas s
    JOIN tipos_atendimento t ON s.tipo_atendimento_id = t.id
    JOIN servicos sv ON s.servico_id = sv.id
    LEFT JOIN usuarios u ON s.atendente_id = u.id
    ORDER BY s.id DESC
");
$senhas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Painel Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-5">
  <h2 class="mb-4">Painel Administrativo</h2>
  <a href="logout.php" class="btn btn-outline-danger mb-3 float-end">Sair</a>

  <table class="table table-bordered table-hover">
    <thead class="table-dark">
      <tr>
        <th>#</th>
        <th>Senha</th>
        <th>Tipo</th>
        <th>Serviço</th>
        <th>Status</th>
        <th>Emissão</th>
        <th>Chamada</th>
        <th>Início</th>
        <th>Fim</th>
        <th>Guichê</th>
        <th>Atendente</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($senhas as $s): ?>
        <tr>
          <td><?= $s['id'] ?></td>
          <td><strong><?= $s['codigo'] ?></strong></td>
          <td><?= $s['tipo_nome'] ?></td>
          <td><?= $s['servico_nome'] ?></td>
          <td><?= ucfirst($s['status']) ?></td>
          <td><?= date('d/m/Y H:i', strtotime($s['data_hora_emissao'])) ?></td>
          <td><?= $s['data_hora_chamada'] ? date('H:i', strtotime($s['data_hora_chamada'])) : '-' ?></td>
          <td><?= $s['data_hora_inicio'] ? date('H:i', strtotime($s['data_hora_inicio'])) : '-' ?></td>
          <td><?= $s['data_hora_fim'] ? date('H:i', strtotime($s['data_hora_fim'])) : '-' ?></td>
          <td><?= $s['guiche_usado'] ?? '-' ?></td>
          <td><?= $s['atendente_nome'] ?? '-' ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</body>
</html>
