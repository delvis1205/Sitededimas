document.getElementById('pedido-form').addEventListener('submit', function(event) {
    event.preventDefault();
    
    const diamantes = document.getElementById('diamantes').value;
    const preco = document.querySelector(`#diamantes option[value="${diamantes}"]`).dataset.preco;
    const idJogador = document.getElementById('id-jogador').value;
    const nomeJogador = document.getElementById('nome-jogador').value;
    const metodoPagamento = document.getElementById('metodo-pagamento').value;
    
    const mensagem = `Pedido de Diamantes:\nQuantidade: ${diamantes} Diamantes\nPreço: ${preco} Kz\nID do Jogador: ${idJogador}\nNome do Jogador: ${nomeJogador}\nMétodo de Pagamento: ${metodoPagamento}`;
    const linkWhatsApp = `https://wa.me/244930441438?text=${encodeURIComponent(mensagem)}`;
    
    window.location.href = linkWhatsApp;
});