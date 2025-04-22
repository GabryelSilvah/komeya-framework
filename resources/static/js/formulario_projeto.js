let form_projetos = document.querySelector("#form_projetos");
let fechar_aba_projetos = document.querySelector("#fechar_aba_projetos");

//Removendo da tela formulário de cadastro quando o X for precionado
fechar_aba_projetos.addEventListener("click", (e) => {
    document.body.setAttribute("style", "overflow:none");
    form_projetos.removeAttribute("style", "display:flex");
    form_projetos.setAttribute("style", "display:none");
    console.log(form_projetos);

})

//Exibir formulário de cadastro quando botão de adicionar for precionado
let button_projetos = document.querySelector("#button_projetos");

button_projetos.addEventListener("click", (e) => {
    document.body.setAttribute("style", "overflow:hidden");
    form_projetos.removeAttribute("style", "display:none");
    form_projetos.setAttribute("style", "display:flex");

});

