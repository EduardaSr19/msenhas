<?php
require 'conexao.php'; // conexão com o banco

// Busca tipos de atendimento
$tipos = $pdo->query("SELECT * FROM tipos_atendimento")->fetchAll(PDO::FETCH_ASSOC);

// Busca serviços
$servicos = $pdo->query("SELECT * FROM servicos")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Emissão de Senha</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="text-center p-5">

  <form method="POST" action="gerar_senha.php">
    <h2 class="mb-4">Selecione o serviço:</h2>
    <select class="form-select mb-3" name="servico_id" required>
      <?php foreach ($servicos as $servico): ?>
        <option value="<?= $servico['id'] ?>"><?= $servico['nome'] ?></option>
      <?php endforeach; ?>
    </select>

    <h2 class="mb-4">Tipo de Atendimento:</h2>
    <select class="form-select mb-4" name="tipo_id" required>
      <?php foreach ($tipos as $tipo): ?>
        <option value="<?= $tipo['id'] ?>"><?= $tipo['nome'] ?></option>
      <?php endforeach; ?>
    </select>

    <button class="btn btn-primary btn-lg" type="submit">Emitir Senha</button>
  </form>
</body>
</html>
