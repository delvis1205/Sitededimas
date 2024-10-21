
// redirect.js
const path = window.location.pathname.split('/').pop();

if (path === 'diamantes') {
    window.location.href = 'diamantes.html';
} else if (path === 'regedits') {
    window.location.href = 'regedits.html';
} else if (path === 'trilha-evolucao') {
    window.location.href = 'trilha-evolucao.html';
} else if (path === 'assinaturas') {
    window.location.href = 'assinaturas.html';
} else if (path === 'codiguins') {
    window.location.href = 'codiguins.html';
} else if (path === 'contas') {
    window.location.href = 'contas.html';
} else if (path === 'itens') {
    window.location.href = 'itens.html';
}
