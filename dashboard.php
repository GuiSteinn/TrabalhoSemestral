<?php require 'back/conexao.php'; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Avaliação</title>
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>
    <div class="dashboard-container">
        <header class="dashboard-header">
            <h1>Painel de Avaliações</h1>
            <p>Resumo das avaliações coletadas</p>
        </header>

        <?php
        $queryMedia = $conexao->query("
            SELECT id_pergunta, perguntas.texto, AVG(resposta) AS media_resposta
            FROM avaliacoes
            JOIN perguntas ON avaliacoes.id_pergunta = perguntas.id
            GROUP BY id_pergunta, perguntas.texto
            ORDER BY id_pergunta
        ");
        $mediaAvaliacoes = $queryMedia->fetchAll(PDO::FETCH_ASSOC);

        $queryFeedback = $conexao->query("
            SELECT p.texto AS pergunta_texto, a.feedback
            FROM avaliacoes a
            JOIN perguntas p ON a.id_pergunta = p.id
            WHERE a.feedback IS NOT NULL AND a.feedback != ''
        ");
        $feedbacks = $queryFeedback->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <section class="media-section">
            <h2><i class="icon-bar-chart"></i> Médias das Avaliações</h2>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Pergunta</th>
                            <th>Média</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($mediaAvaliacoes as $media): ?>
                            <tr>
                                <td><?php echo "Pergunta " . htmlspecialchars($media['id_pergunta']) . ": " . htmlspecialchars($media['texto']); ?></td>
                                <td><?php echo number_format($media['media_resposta'], 2); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>

        <section class="feedback-section">
            <h2><i class="icon-comments"></i> Feedbacks</h2>
            <div class="feedback-list">
                <?php foreach ($feedbacks as $feedback): ?>
                    <div class="feedback-item">
                        <p><strong><?php echo htmlspecialchars($feedback['pergunta_texto']); ?></strong></p>
                        <p><?php echo htmlspecialchars($feedback['feedback']); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    </div>
</body>
</html>
