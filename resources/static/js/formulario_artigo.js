let form_artigos = document.querySelector("#form_artigos");
let fechar_aba_artigos = document.querySelector("#fechar_aba_artigos");

//Removendo da tela formulário de cadastro quando o X for precionado
fechar_aba_artigos.addEventListener("click", (e) => {
    document.body.setAttribute("style", "overflow:none");
    form_artigos.removeAttribute("style", "display:flex");
    form_artigos.setAttribute("style", "display:none");
})

//Exibir formulário de cadastro quando botão de adicionar for precionado
let button_artigos = document.querySelector("#button_artigos");

button_artigos.addEventListener("click", (e) => {
    document.body.setAttribute("style", "overflow:hidden");
    form_artigos.removeAttribute("style", "display:none");
    form_artigos.setAttribute("style", "display:flex");
});

