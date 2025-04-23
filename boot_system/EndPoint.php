<?php

namespace Komeya\boot_system;

use Komeya\core\router\Web_request;


class EndPoint
{

	public function route()
	{
		Web_request::get("/", "AuthController", "telaLogin")->permitAll();
		Web_request::get("/login", "AuthController", "telaLogin")->permitAll()->formLogin();
		Web_request::post("/autenticar", "AuthController", "autenticar")->permitAll();
		Web_request::get("/sair", "AuthController", "logout");

		Web_request::get("/cadastrar", "UsuarioController", "cadastrar")->role();
		Web_request::get("/painel", "PainelController", "exibir");
		Web_request::get("/receitas", "ReceitaController", "exibir")->role();
		Web_request::anyAuthorized();
	}


}
