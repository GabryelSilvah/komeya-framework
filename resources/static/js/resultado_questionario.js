let circulo_progresso = document.querySelector(".pontos");
let campoPorcentagem = document.querySelector("#porcentagem");

let porcentagem = 97 * 3.6;
campoPorcentagem.innerHTML = 97+"%";
circulo_progresso.style = "background:conic-gradient(rgb(255, 200, 0)" + porcentagem + "deg, #fff 0deg);";
