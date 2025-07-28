<?php
session_start();
require 'conexao.php';

// Verifica se o usuário é admin
if (!isset($_SESSION['usuario_id']) || $_SESSION['perfil'] !== 'admin') {
    header("Location: login.php");
    exit;
}

// Busca todos os usuários do sistema
$stmt = $pdo->query("SELECT * FROM usuarios ORDER BY id DESC");
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Gerenciar Usuários</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-5">
  <h2 class="mb-4">Gerenciamento de Usuários</h2>

  <a href="form_usuario.php" class="btn btn-success mb-3">➕ Novo Usuário</a>
  <a href="painel_admin.php" class="btn btn-secondary mb-3">⬅️ Voltar ao Painel Admin</a>

  <table class="table table-bordered">
    <thead class="table-dark">
      <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Email</th>
        <th>Perfil</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($usuarios as $u): ?>
        <tr>
          <td><?= $u['id'] ?></td>
          <td><?= $u['nome'] ?></td>
          <td><?= $u['email'] ?></td>
          <td><?= ucfirst($u['perfil']) ?></td>
          <td>
            <a href="form_usuario.php?id=<?= $u['id'] ?>" class="btn btn-sm btn-primary">Editar</a>
            <?php if ($u['id'] != $_SESSION['usuario_id']): ?>
              <a href="excluir_usuario.php?id=<?= $u['id'] ?>" class="btn btn-sm btn-danger"
                 onclick="return confirm('Deseja excluir este usuário?')">Excluir</a>
            <?php else: ?>
              <span class="text-muted">[Você]</span>
            <?php endif; ?>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</body>
</html>
