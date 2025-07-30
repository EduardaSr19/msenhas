<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario_id']) || $_SESSION['perfil'] !== 'admin') {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title><?= $titulo ?? 'Painel Admin' ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <style>
    /* ====== LAYOUT BASE ====== */
    body {
      display: flex;
      min-height: 100vh;
      background-color: #FFFFFF;
      font-family: 'Segoe UI', sans-serif;
    }

    /* ====== SIDEBAR ====== */
    .sidebar {
      width: 250px;
      background: #F4F4F4;
      color: white;
      flex-shrink: 0;
    }

    .sidebar .logo {
      text-align: center;
      padding: 20px;
      border-bottom: 1px solid rgba(255,255,255,0.1);
    }

    .sidebar .logo img {
      width: 120px;
      
    }

    .sidebar h4 {
      text-align: center;
      margin: 15px 0;
      font-weight: 500;
      color: #ddd;
    }

    .sidebar a {
      color: #bbb;
      text-decoration: none;
      display: flex;
      align-items: center;
      padding: 14px 20px;
      font-size: 15px;
      transition: 0.3s;
    }

    .sidebar a i {
      margin-right: 10px;
      font-size: 16px;
    }

    .sidebar a:hover {
      background-color: #343a55;
      color: #fff;
      padding-left: 25px;
    }

    .sidebar .text-danger:hover {
      background-color: #a94442;
    }

    /* ====== CONTEÚDO ====== */
    .content {
      flex-grow: 1;
      padding: 25px;
      background-color: #FFFFFF;
    }

    .page-title {
      font-size: 24px;
      font-weight: 600;
      margin-bottom: 20px;
      color: #333;
    }

    /* ====== CARDS DASHBOARD ====== */
    .card-custom {
      border: none;
      border-radius: 12px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.08);
      transition: 0.3s ease-in-out;
    }

    .card-custom:hover {
      transform: translateY(-4px);
      box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    /* ====== FOOTER ====== */
    .footer {
      background-color: #1e1e2f;
      color: white;
      text-align: center;
      padding: 12px;
      position: fixed;
      bottom: 0;
      left: 250px;
      right: 0;
      font-size: 14px;
    }

    .footer img {
      height: 20px;
      margin-right: 8px;
      vertical-align: middle;
    }
  </style>
</head>
<body>
  <!-- Sidebar -->
  <div class="sidebar">
    <div class="logo">
      <img src="logo-unimed.png" alt="Logo">
    </div>
    <h4>Painel Admin</h4>
    <a href="painel_admin.php"><i class="fas fa-home"></i> Dashboard</a>
    <a href="usuarios.php"><i class="fas fa-users"></i> Usuários</a>
    <a href="form_servico.php"><i class="fas fa-briefcase"></i> Serviços</a>
    <a href="form_tipo_atendimento.php"><i class="fas fa-list"></i> Tipos de Atendimento</a>
    <a href="logout.php" class="text-danger"><i class="fas fa-sign-out-alt"></i> Sair</a>
  </div>

  <!-- Conteúdo -->
  <div class="content">
