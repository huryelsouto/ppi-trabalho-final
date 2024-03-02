function mostrarConteudo(conteudo) {
    var conteudoDiv = document.getElementById("conteudo-container");
    conteudoDiv.innerHTML = "Conteúdo da página " + conteudo;
}

function toggleMenu() {
    var menu_content = document.getElementById('menu-content');
    menu_content.classList.toggle('expandido');

    var menu = document.getElementById('menu');
    menu.classList.toggle('expandido');
}