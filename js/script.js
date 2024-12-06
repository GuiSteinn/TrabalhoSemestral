document.addEventListener('DOMContentLoaded', function () {
    const botaoProximo = document.getElementById('proximo');
    const perguntas = document.querySelectorAll('.questao');
    const botaoEnviar = document.getElementById('enviar');
    let perguntaAtual = 0;

    botaoProximo.addEventListener('click', () => {
        const perguntaAtualDiv = perguntas[perguntaAtual];
        const respostaSelecionada = perguntaAtualDiv.querySelector('input[type="radio"]:checked');

        if (!respostaSelecionada) {
            alert('Por favor, selecione uma resposta.');
            return;
        }

        perguntaAtualDiv.style.display = 'none';
        perguntaAtual++;

        if (perguntaAtual < perguntas.length) {
            perguntas[perguntaAtual].style.display = 'block';
        } else {
            botaoProximo.style.display = 'none';
            botaoEnviar.style.display = 'block';
        }
    });

    
    let inatividadeTimeout;
    const tempoInatividade = 30000; 

    function resetarInatividade() {
        clearTimeout(inatividadeTimeout);
        inatividadeTimeout = setTimeout(() => {
            location.reload(); 
        }, tempoInatividade);
    }

    document.addEventListener('mousemove', resetarInatividade);
    document.addEventListener('keydown', resetarInatividade);
    document.addEventListener('click', resetarInatividade);
    document.addEventListener('touchstart', resetarInatividade);

    const telaInicial = document.getElementById('intro');
    const avaliacaoContainer = document.getElementById('avaliacao-container');

    telaInicial.addEventListener('click', () => {
        telaInicial.style.display = 'none';
        avaliacaoContainer.style.display = 'block';
        resetarInatividade(); 
    });
});
