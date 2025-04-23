<?php

namespace Komeya\core\router;

use Exception;
use Komeya\core\exceptions\Web_requestException;
use ReflectionClass;



class Web_request
{
	private static $GET = [];
	private static $POST = [];
	private static $PUT = [];
	private static $DELETE = [];
	private static $FORM_LOGIN;

	private static $positionRoute;
	private static $authorized = true;
	private static $arrayRoutePermision;


	public function __construct($arrayRoutePermision, $positionRoute)
	{

		self::$arrayRoutePermision = $arrayRoutePermision;
		self::$positionRoute = $positionRoute;
	}

	public static function get(string $route, string $controller, $method)
	{

		if (empty($route)) {
			throw new Exception("Rota não informado");
		}

		if (empty($controller)) {
			throw new Exception("Controller não informada");
		}

		if (empty($method)) {
			throw new Exception("Método da controller não informado");
		}

		array_push(self::$GET, [$route, $controller, $method, "authorized"]);

		return new self("GET", count(self::$GET) - 1);
	}
	public static function post(string $route, string $controller, $method)
	{

		if (empty($route)) {
			throw new Exception("Rota não informado");
		}

		if (empty($controller)) {
			throw new Exception("Controller não informada");
		}

		if (empty($method)) {
			throw new Exception("Método da controller não informado");
		}

		array_push(self::$POST, [$route, $controller, $method, "authorized"]);

		return new self("POST", count(self::$POST) - 1);
	}

	/*Iniciar processamento das rotas configuradas no arquivo EndPoint*/
	public static function start_route()
	{
		//Pegando verbo HTTP usado na requisição
		$methodRequest = $_SERVER["REQUEST_METHOD"];


		switch ($methodRequest) {
			case "GET":
				self::instanceController(self::$GET);
				break;
			case "POST":
				self::instanceController(self::$POST);
				break;
			case "PUT":
				self::instanceController(self::$PUT);
				break;
			case "DELETE":
				self::instanceController(self::$DELETE);
				break;

			default:
				throw new Exception("O verbo HTTP utilizado não é suportado pela classe Web_request");
				break;
		}
	}

	/*Buscar e retornar URL da request*/
	public static function getUrl(): array
	{
		$url = $_SERVER["REQUEST_URI"];
		$urlRoute = explode("/", $url);
		return $urlRoute;
	}


	/*Identificar qual o indice do array que está armazenado a rota da URL pesquisada no navegador*/
	public static function findUrlInArray(array $arrayRoute, string $urlRoute)
	{

		for ($i = 0; $i < count($arrayRoute); $i++) {

			$position = $i;

			if ($arrayRoute[$position][0] == $urlRoute) {
				return $position;
			}
		}
		return false;
	}
	/*Criar a instancia das controllers definidas no arquivo EndPoint*/
	public static function instanceController(&$dataRoute)
	{

		/*Require automatica das classes controllers*/
		self::autoRequire();
		/*
		*Procurar indice do array onde contém a controller a ser chamada
		*de acordo com a rota passada
		*Exemplo: /cadastar (está localizada no indice 2 do arrayPost)
		*/
		$url = self::getUrl();
		$positionArray = self::findUrlInArray($dataRoute, "/" . $url[2]);

		/*Validações*/
		self::validationsBeforeInstance($positionArray, $dataRoute, $url);

		/*Passando controller e método armazenados no array para variáveis separadas*/
		$controller = NAMESPACE_DEFAULT . "\\controller\\" . $dataRoute[$positionArray][1];
		$method = $dataRoute[$positionArray][2];

		/*Validar se controller passada no arquivo de rota existe*/
		if (!class_exists($controller)) {
			throw new Exception("Controller não existe");
		}

		/*Validar se método passado no arquivo de rota existe na controller*/
		if (!method_exists($controller, $method)) {
			throw new Exception("Método ($method) não existe na controller ($controller)");
		}


		/*
		*Pegando classe controller, instanciado e chamando método
		*/
		$reflection = new ReflectionClass($controller);
		$controller = $reflection->newInstance();
		$controller->$method();
	}

	//Marca rota como acesso permitido por todos os usuários, autenticados e não autenticados
	public function permitAll()
	{

		switch (self::$arrayRoutePermision) {
			case "GET":
				self::$GET[self::$positionRoute][3] = "approved";
				break;
			case "POST":
				self::$POST[self::$positionRoute][3] = "approved";
				break;
		}

		return $this;
	}

	//Marcar todas as rotas como acesso somente autenticado, as que não são do tipo pirmitAll()
	public static function anyAuthorized()
	{
		self::$authorized = false;
		if (isset($_SESSION["usuario"]) && !empty($_SESSION["usuario"])) {
			self::$authorized = true;
		}
	}

	/*Nível de acesso*/
	public function role() {}

	//Marca rota como formulário de login/autenticação
	public function formLogin()
	{
		self::$FORM_LOGIN = self::$GET[self::$positionRoute][0];
	}

	/*Require automatica das classes controllers*/
	public static function autoRequire()
	{
		spl_autoload_register(
			function (string $nomeClasse) {

				$caminhoCompleto = str_replace('Komeya\\app', "..\\..\\src\\app", $nomeClasse);
				$caminhoCompleto = str_replace('\\', DIRECTORY_SEPARATOR, $caminhoCompleto);

				$pathFile =  $caminhoCompleto . ".php";

				if (file_exists($pathFile)) {
					require_once($pathFile);
				}
			}
		);
	}

	/*Validações da instanceController*/
	public static function validationsBeforeInstance(&$positionArray, &$dataRoute, $url)
	{
		/*Validando se foi encontrado alguma rota dentro do array de rotas que seja igual a url da requisição atual*/
		if ($positionArray === false) {
			throw new Web_requestException("Rota (/{$url[2]}) não existe no arquivo de EndPoint para o verbo HTTP usado.");
		}

		/*Validando permissão concedida para a rota, (permitAll, anyAuthorized)*/
		if ($dataRoute[$positionArray][3] == "authorized" && self::$authorized == false) {
			$positionArray = self::findUrlInArray($dataRoute, self::$FORM_LOGIN);
		}

		/*Validando se usuário está logado, caso sim, bloquear acesso a página de login*/
		if (isset($_SESSION["usuario"]) && !empty($_SESSION["usuario"]) && "/" . $url[2] == self::$FORM_LOGIN) {
			die;
		}

		/*Caso nenhuma rota tem sido configurada um exception será disparada*/
		if (empty($dataRoute[$positionArray])) {
			throw new Web_requestException("Rota (/{$url[2]}) não existe no arquivo de EndPoint para o verbo HTTP usado.");
		}
	}
}
