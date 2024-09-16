// Código para o formulário de pedido de diamantes
document.getElementById('pedido-form').addEventListener('submit', function(event) {
    event.preventDefault();
    
    const diamantes = document.getElementById('diamantes').value;
    const preco = document.querySelector(`#diamantes option[value="${diamantes}"]`).dataset.preco;
    const idJogador = document.getElementById('id-jogador').value;
    const nomeJogador = document.getElementById('nome-jogador').value;
    const metodoPagamento = document.getElementById('metodo-pagamento').value;
    
    const mensagem = `Pedido de Diamantes:\nQuantidade: ${diamantes} Diamantes\nPreço: ${preco} Kz\nID do Jogador: ${idJogador}\nNome do Jogador: ${nomeJogador}\nMétodo de Pagamento: ${metodoPagamento}`;
    
    const linkWhatsApp = `whatsapp://send/?phone=244930441438&text=${encodeURIComponent(mensagem)}&type=phone_number&app_absent=0`;
    
    window.location.href = linkWhatsApp;
});

// Código para o chatbot do Dialogflow
window.onload = function() {
    const chatWidget = document.createElement('script');
    chatWidget.src = 'https://www.gstatic.com/dialogflow/fulfillment-webhook.js';
    chatWidget.async = true;
    document.body.appendChild(chatWidget);

    const chatbotFrame = document.createElement('iframe');
    chatbotFrame.src = 'https://dialogflow.cloud.google.com/v1/integrations/web-demo/';
    chatbotFrame.style.position = 'fixed';
    chatbotFrame.style.bottom = '0';
    chatbotFrame.style.right = '0';
    chatbotFrame.style.width = '400px';
    chatbotFrame.style.height = '600px';
    chatbotFrame.style.border = 'none';
    document.body.appendChild(chatbotFrame);
};
