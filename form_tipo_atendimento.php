<?php
session_start();
require 'conexao.php';

// Verifica se é admin
if (!isset($_SESSION['usuario_id']) || $_SESSION['perfil'] !== 'admin') {
    header("Location: login.php");
    exit;
}

include 'template_admin.php'; // Cabeçalho e menu lateral
?>

<div class="container py-4">
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
</div>

<?php include 'footer_admin.php'; ?>
