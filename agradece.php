<?php require 'back/conexao.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agradecimento - HRAV</title>
    <link rel="stylesheet" href="css/agradece.css">
</head>
<body>
    <div class="agradecimento-container">
        <div class="agradecimento-card">
            <h1>Obrigado pela sua participação!</h1>
            <p>
                O Hospital Regional Alto Vale (HRAV) agradece sinceramente pela sua contribuição. Sua avaliação é essencial para que possamos melhorar continuamente nossos serviços e oferecer um atendimento cada vez mais humanizado e eficiente.
            </p>
            <p id="contagem-regressiva">Você será redirecionado em <span id="tempo">10</span> segundos.</p>
        </div>
    </div>

    <script>
        let tempo = 10;
        const tempoElement = document.getElementById('tempo');
        const idDispositivo = "<?php echo $_GET['id_dispositivo']; ?>";

        const countdown = setInterval(() => {
            tempo--;
            tempoElement.textContent = tempo;

            if (tempo <= 0) {
                clearInterval(countdown);
                window.location.href = 'index.php?id_dispositivo=' + idDispositivo;
            }
        }, 1000);
    </script>
</body>
</html>
