<?php
$host = 'localhost';
$db = 'TrabalhoSemestral';
$user = 'postgres';
$pass = 'postgres';

try {
    $conexao = new PDO("pgsql:host=$host;dbname=$db", $user, $pass);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}
