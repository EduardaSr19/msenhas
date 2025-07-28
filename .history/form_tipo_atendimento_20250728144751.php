<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Cadastrar Tipo de Atendimento</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-5">
  <h2 class="mb-4">Cadastrar Tipo de Atendimento</h2>

  <form method="POST" action="cadastrar_tipo_atendimento.php">
    <div class="mb-3">
      <label for="nome" class="form-label">Nome do Tipo:</label>
      <input type="text" class="form-control" id="nome" name="nome" required placeholder="Ex: Comum, Preferencial">
    </div>

    <div class="mb-3">
      <label for="prefixo" class="form-label">Prefixo:</label>
      <input type="text" class="form-control" id="prefixo" name="prefixo" maxlength="1" required placeholder="Ex: A, P">
    </div>

    <button type="submit" class="btn btn-primary">Cadastrar</button>
    <a href="emite.php" class="btn btn-secondary ms-2">Voltar</a>
  </form>
</body>
</html>
