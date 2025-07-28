<?php
$host = 'localhost';
$dbname = 'msenhas';  // <- substitua pelo nome real do banco
$user = 'root';     // <- substitua pelo usuário real (ex: root)
$pass = '!Zortea82/';       // <- substitua pela senha real

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    // Habilita o modo de erros com exceção
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}
