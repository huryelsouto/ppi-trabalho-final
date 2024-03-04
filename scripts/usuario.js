window.onload = function() {
    mostrarConteudo("client-table")
}

function mostrarConteudo(id_conteudo) {
    var iframes = document.querySelectorAll(".iframe-component");

    iframes.forEach(elem => {
        if (elem.id == id_conteudo) {
            elem.classList.add("visible");
            elem.style.height = elem.contentWindow.document.body.scrollHeight + 'px';
        } else {
            elem.classList.remove("visible");
        }
    });
}

function toggleMenu() {
    var menu_content = document.getElementById('menu-content');
    menu_content.classList.toggle('expandido');

    var menu = document.getElementById('menu');
    menu.classList.toggle('expandido');
}