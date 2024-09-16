document.addEventListener('DOMContentLoaded', function() {
    // Animação de parabéns
    function showCongratulations() {
        const congratulations = document.createElement('div');
        congratulations.innerHTML = '<h2>Parabéns!</h2><p>Seu pedido foi enviado com sucesso.</p>';
        congratulations.style.position = 'fixed';
        congratulations.style.top = '50%';
        congratulations.style.left = '50%';
        congratulations.style.transform = 'translate(-50%, -50%)';
        congratulations.style.backgroundColor = '#00ff00';
        congratulations.style.color = '#fff';
        congratulations.style.padding = '20px';
        congratulations.style.borderRadius = '10px';
        congratulations.style.boxShadow = '0 0 10px rgba(0, 0, 0, 0.5)';
        congratulations.style.zIndex = '1000';
        document.body.appendChild(congratulations);

        setTimeout(() => {
            document.body.removeChild(congratulations);
        }, 3000); // Remover a mensagem após 3 segundos
    }

    // Código para o formulário de pedido de diamantes
    document.getElementById('pedido-form').addEventListener('submit', function(event) {
        event.preventDefault();
        
        const diamantes = document.getElementById('diamantes').value;
        const preco = document.querySelector(`#diamantes option[value="${diamantes}"]`).dataset.preco;
        const idJogador = document.getElementById('id-jogador').value;
        const nomeJogador = document.getElementById('nome-jogador').value;
        const metodoPagamento = document.getElementById('metodo-pagamento').value;
        
        const mensagem = `Pedido de Diamantes:\nQuantidade: ${diamantes} Diamantes\nPreço: ${preco} Kz\nID do Jogador: ${idJogador}\nNome do Jogador: ${nomeJogador}\nMétodo de Pagamento: ${metodoPagamento}`;
        
        showCongratulations(); // Exibir animação de parabéns

        // Redirecionar para o WhatsApp após a animação
        setTimeout(() => {
            const linkWhatsApp = `whatsapp://send/?phone=244930441438&text=${encodeURIComponent(mensagem)}&type=phone_number&app_absent=0`;
            window.location.href = linkWhatsApp;
        }, 3000); // Redirecionar após 3 segundos
    });
});
