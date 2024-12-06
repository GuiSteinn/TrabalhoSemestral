<?php
require 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_dispositivo = $_POST['id_dispositivo'] ?? null;

    if (!$id_dispositivo || empty($_POST['id_pergunta']) || empty($_POST['resposta'])) {
        die("Dados insuficientes para salvar a avaliação.");
    }

    try {
        $query = $conexao->prepare(
            "INSERT INTO avaliacoes (id_dispositivo, id_pergunta, resposta, feedback) VALUES (?, ?, ?, ?)"
        );

        for ($i = 0; $i < count($_POST['id_pergunta']); $i++) {
            $id_pergunta = $_POST['id_pergunta'][$i];
            $resposta = $_POST['resposta'][$i];
            $feedback = $_POST['feedback'][$i] ?? null; 

            $query->execute([$id_dispositivo, $id_pergunta, $resposta, $feedback]);
        }

        header("Location: ../agradece.php?id_dispositivo=" . urlencode($id_dispositivo));
        exit;
        
    } catch (PDOException $e) {
        die("Erro ao salvar a avaliação: " . $e->getMessage());
    }
} else {
    header("Location: ../index.php");
    exit;
}
?>
