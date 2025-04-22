<?php

namespace Komeya\boot_system;

use Komeya\core\router\Web_request;

class EndPoint
{

	public function route()
	{
		Web_request::get("/", "AuthController", "telaLogin");
		Web_request::get("/login", "AuthController", "telaLogin");
		Web_request::post("/autenticar", "AuthController", "autenticar");
		Web_request::get("/sair", "AuthController", "logout");

		Web_request::get("/cadastrar", "UsuarioController", "cadastrar");
		Web_request::get("/painel", "PainelController", "exibir");
		Web_request::get("/receitas", "ReceitaController", "exibir");
		//Url_request::get("/login", "UsuarioController", "exibir")->restController()->permitAll();
		//Url_request::get("/painel", "SistemaController", "exibir")->restController()->authenticate();

	}
}
