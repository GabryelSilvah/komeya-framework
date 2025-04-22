let form_projetos = document.querySelector("#form_perfil");
let fechar_aba_projetos = document.querySelector("#fechar_aba_perfil");

//Removendo da tela formulário de cadastro quando o X for precionado
fechar_aba_perfil.addEventListener("click", (e) => {
    document.body.setAttribute("style", "overflow:none");
    form_projetos.removeAttribute("style", "display:flex");
    form_projetos.setAttribute("style", "display:none");
    console.log(form_perfil);

})

//Exibir formulário de cadastro quando botão de adicionar for precionado
let button_perfil = document.querySelector("#button_perfil");

button_perfil.addEventListener("click", (e) => {
    document.body.setAttribute("style", "overflow:hidden");
    form_projetos.removeAttribute("style", "display:none");
    form_projetos.setAttribute("style", "display:flex");

});

