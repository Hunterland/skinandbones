
// FUNCÕES PARA EXPANDIR E RETRAIR TEXTO

function leiaMais() {
    var pontos = document.getElementById("pontos");
    var maisTexto = document.getElementById("mais");
    var btnVerMais = document.getElementById("btnVerMais");


    if(pontos.style.display === "none"){
        pontos.style.display = "inline";
        maisTexto.style.display = "none";
        btnVerMais.innerHTML = "Ver Mais";
    }else {
        pontos.style.display = "none";
        maisTexto.style.display = "inline";
        btnVerMais.innerHTML = "Ver Menos";
    }
}

function vejaMais() {
    var pontos = document.getElementById("pontos1");
    var maisTexto = document.getElementById("mais1");
    var btnVerMais1 = document.getElementById("btnVerMais1");


    if(pontos.style.display === "none"){
        pontos.style.display = "inline";
        maisTexto.style.display = "none";
        btnVerMais1.innerHTML = "Ver Mais";
    }else {
        pontos.style.display = "none";
        maisTexto.style.display = "inline";
        btnVerMais1.innerHTML = "Ver Menos";
    }
}


