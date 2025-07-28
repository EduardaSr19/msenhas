<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Cadastrar Usuário</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container py-5">
  <h2 class="mb-4">Cadastrar Novo Usuário</h2>

  <form method="POST" action="salvar_usuario.php">
    <div class="mb-3">
      <label for="nome" class="form-label">Nome:</label>
      <input type="text" name="nome" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="email" class="form-label">E-mail:</label>
      <input type="email" name="email" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="senha" class="form-label">Senha
        <?= isset($usuario) ? '(preencha apenas se for alterar)' : '' ?>:</label>
      <input type="password" name="senha" class="form-control" <?= isset($usuario) ? '' : 'required' ?>>

    </div>

    <div class="mb-3">
      <label for="perfil" class="form-label">Perfil:</label>
      <select name="perfil" class="form-select" required>
        <option value="atendente">Atendente</option>
        <option value="admin">Administrador</option>
      </select>
    </div>

    <button type="submit" class="btn btn-primary">Cadastrar</button>
  </form>
</body>

</html>