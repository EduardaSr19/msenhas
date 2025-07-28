<?php
require 'conexao.php';

$id     = $_POST['id'] ?? null;
$nome   = $_POST['nome'] ?? '';
$email  = $_POST['email'] ?? '';
$senha  = $_POST['senha'] ?? '';
$perfil = $_POST['perfil'] ?? '';

if (!$nome || !$email || !$perfil) {
    die("Dados incompletos.");
}

try {
    if ($id) {
        // Atualizar usuário existente
        if (!empty($senha)) {
            // Atualiza com nova senha
            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("UPDATE usuarios SET nome = ?, email = ?, senha = ?, perfil = ? WHERE id = ?");
            $stmt->execute([$nome, $email, $senhaHash, $perfil, $id]);
        } else {
            // Atualiza sem alterar a senha
            $stmt = $pdo->prepare("UPDATE usuarios SET nome = ?, email = ?, perfil = ? WHERE id = ?");
            $stmt->execute([$nome, $email, $perfil, $id]);
        }
        header("Location: usuarios.php");
    } else {
        // Inserir novo usuário
        if (!$senha) {
            die("Senha obrigatória para novo usuário.");
        }
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha, perfil) VALUES (?, ?, ?, ?)");
        $stmt->execute([$nome, $email, $senhaHash, $perfil]);
        header("Location: usuarios.php");
    }
    exit;
} catch (Exception $e) {
    echo "Erro ao salvar: " . $e->getMessage();
}
