<?php
require 'conexao.php';

// Busca a última senha chamada (status = chamada), mais recente
$stmt = $pdo->query("
  SELECT s.codigo, s.guiche_usado
  FROM senhas s
  WHERE s.status = 'chamada'
  ORDER BY s.data_hora_chamada DESC
  LIMIT 1
");

$senha = $stmt->fetch(PDO::FETCH_ASSOC);
$guiche = $senha['guiche_usado'] ?? '---';


// Prepara texto para áudio
$texto_audio = $senha
  ? "Senha {$senha['codigo']}, guichê {$guiche}"
  : "";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Telão</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: black;
      color: white;
      text-align: center;
      padding-top: 100px;
      font-family: 'Arial Black', sans-serif;
    }

    .senha {
      font-size: 120px;
    }

    .guiche {
      font-size: 60px;
    }
  </style>
</head>
<body>

  <div class="senha">
    <?= $senha ? $senha['codigo'] : '---' ?>
  </div>
  <div class="guiche">
    <?= $senha ? "Guichê $guiche" : 'Aguardando chamada...' ?>
  </div>

  <?php if ($senha): ?>
    <audio autoplay id="audio">
      <source src="https://api.streamelements.com/kappa/v2/speech?voice=Vitoria&text=<?= urlencode($texto_audio) ?>" type="audio/mpeg">
    </audio>
  <?php endif; ?>

  <script>
    // Atualiza a cada 5 segundos
    setTimeout(() => {
      window.location.reload();
    }, 5000);
  </script>
</body>
</html>
