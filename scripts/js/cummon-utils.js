function ajustarAlturaIframes() {
    var iframes = document.querySelectorAll('.iframe-component');

    iframes.forEach(element => {
        element.style.height = element.contentWindow.document.body.scrollHeight + 'px';
    });
}

// Chama a função ao carregar a página e ao redimensionar a janela
window.onload = ajustarAlturaIframes;
window.onresize = ajustarAlturaIframes;