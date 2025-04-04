let class_minutos = document.querySelector(".minutos");
let class_segundos = document.querySelector(".segundos");


//Pegar o tempo exato onde quando a questão começar
const tempoInicial = new Date().getTime();
//Adicionar ao tempo inicial 3 minutos
const tempoAcrescido = tempoInicial + (1000 * 60 * 1);

function diminuirtempo() {
    let tempoCronometro = Date.now();
 
    //enquanto o tempo do cronometro for maior que 0 faça a subtração
    if (tempoAcrescido - tempoCronometro > 0) {

        //Subtraindo tempo
       let  diferenca = (tempoAcrescido - tempoCronometro);
        let minuto = Math.floor(diferenca / 1000 / 60) % 60;
        let segundos = Math.floor(diferenca / 1000) % 60;

        class_minutos.innerHTML = minuto < 10 ? "0" + minuto : minuto;
        class_segundos.innerHTML = segundos < 10 ? "0" + segundos : segundos;
    }else{
        //window.location.href = "http://localhost:8007/plataforma_kevigo/questionario/iniciar/1";
    }
}
setInterval(diminuirtempo, 1000);
