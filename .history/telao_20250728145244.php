<?php
require 'conexao.php';

// Busca a última senha chamada (status = chamada), mais recente
$stmt = $pdo->query("
  SELECT s.codigo, u.nome AS atendente, s.data_hora_chamada, 
         s.status, s.atendente_id
  FROM senhas s
  LEFT JOIN usuarios u ON s.atendente_id = u.id
  WHERE s.status = 'chamada'
  ORDER BY s.data_hora_chamada DESC
  LIMIT 1
");

$senha = $stmt->fetch(PDO::FETCH_ASSOC);

// Recupera guichê da sessão do atendente via outra lógica (aqui vamos simular)
$guiche = isset($senha['atendente_id']) ? $_SESSION['guiche'] ?? '...' : '...';

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
