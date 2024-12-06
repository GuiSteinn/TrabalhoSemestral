<?php
require 'back/conexao.php';

$idDispositivo = $_GET['id_dispositivo'] ?? null;

if (!$idDispositivo) {
    die("Nenhum dispositivo foi selecionado.");
}

$consultaPerguntas = $conexao->prepare("SELECT * FROM perguntas WHERE id_dispositivo = ? AND status = TRUE");
$consultaPerguntas->execute([$idDispositivo]);
$listaPerguntas = $consultaPerguntas->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avaliação de Serviços</title>
    <link rel="stylesheet" href="css/index.css">
    <script src="js/script.js" defer></script>
</head>
<body>
    <div id="intro" class="intro">
        <h1>Bem-vindo(a)!</h1>
        <p>Toque na tela para começar sua avaliação.</p>
    </div>
    <div id="avaliacao-container" class="container" style="display: none;">
        <h1>Avaliação de Serviços</h1>
        <form id="avaliacao" action="back/salvar_avaliacao.php" method="POST">
            <input type="hidden" name="id_dispositivo" value="<?php echo $idDispositivo; ?>">
            <div id="perguntas">
                <?php foreach ($listaPerguntas as $indice => $pergunta): ?>
                    <div class="questao" id="questao-<?php echo $indice; ?>" 
                        style="display: <?php echo $indice === 0 ? 'block' : 'none'; ?>;">
                        <h2><?php echo htmlspecialchars($pergunta['texto']); ?></h2>
                        <input type="hidden" name="id_pergunta[]" value="<?php echo $pergunta['id']; ?>">
                        <div class="avaliacao">
                            <?php for ($i = 0; $i <= 10; $i++): ?>
                                <label>
                                    <input type="radio" name="resposta[<?php echo $indice; ?>]" value="<?php echo $i; ?>" required>
                                    <span class="bolinha bolinha-<?php echo $i; ?>"><?php echo $i; ?></span>
                                </label>
                            <?php endfor; ?>
                        </div>
                        <div class="feedback">
                            <label>Feedback (opcional):</label>
                            <textarea name="feedback[<?php echo $indice; ?>]" rows="3" placeholder="Comentários..."></textarea>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <button type="button" id="proximo">Próximo</button>
            <button type="submit" id="enviar" style="display: none;">Enviar</button>
        </form>
        <footer>
            <p>Avaliação anônima, sem coleta de dados pessoais.</p>
        </footer>
    </div>
</body>
</html>
