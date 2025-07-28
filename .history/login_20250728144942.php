<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Login Atendente</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-5">
  <h2 class="mb-4">Login da Atendente</h2>

  <?php if (!empty($_SESSION['erro'])): ?>
    <div class="alert alert-danger"><?= $_SESSION['erro'] ?></div>
    <?php unset($_SESSION['erro']); ?>
  <?php endif; ?>

  <form method="POST" action="valida_login.php">
    <div class="mb-3">
      <label for="email" class="form-label">E-mail:</label>
      <input type="email" class="form-control" name="email" required>
    </div>

    <div class="mb-3">
      <label for="senha" class="form-label">Senha:</label>
      <input type="password" class="form-control" name="senha" required>
    </div>

    <div class="mb-3">
      <label for="guiche" class="form-label">Guichê:</label>
      <input type="number" class="form-control" name="guiche" min="1" required>
    </div>

    <button type="submit" class="btn btn-primary">Entrar</button>
  </form>
</body>
</html>
