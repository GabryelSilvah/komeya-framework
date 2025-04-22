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

		array_push(self::$GET, [$route, $controller, $method]);
		return new self;
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

		array_push(self::$POST, [$route, $controller, $method]);
		return new self;
	}

	public static function start_route()
	{

		$methodRequest = $_SERVER["REQUEST_METHOD"];


		switch ($methodRequest) {
			case "GET":
				self::startController(self::$GET);
				break;
			case "POST":
				self::startController(self::$POST);
				break;
			case "PUT":
				self::startController(self::$PUT);
				break;
			case "DELETE":
				self::startController(self::$DELETE);
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
	public static function findUrlInArray($arrayVerb, string $urlRoute)
	{

		for ($i = 0; $i < count($arrayVerb); $i++) {

			$position = $i;

			if ($arrayVerb[$position][0] == $urlRoute) {
				return $position;
			}
		}
		return null;
	}

	public static function startController(&$dataRoute)
	{
		//Fazendo require automatico da classe
		spl_autoload_register(
			function (string $nomeClasse) {

				$caminhoCompleto = str_replace('Komeya\\app', "..\\..\\src\\app", $nomeClasse);
				$caminhoCompleto = str_replace('\\', DIRECTORY_SEPARATOR, $caminhoCompleto);

				$pathFile =  $caminhoCompleto . ".php";

				//echo "Classe recebida: " . $nomeClasse . "<br><br>";
				//echo "Classe pronta: " . $caminhoCompleto . "<br><br>";
				if (file_exists($pathFile)) {
					require_once($pathFile);
				}
			}
		);

		/*
		*Procurar indice do array onde contém a controller a ser chamada
		*de acordo com a rota passada
		*Exemplo: /cadastar (está localizada no indice 2 do arrayPost)
		*/
		$url = self::getUrl();
		$positionArray = self::findUrlInArray($dataRoute, "/" . $url[2]);

		/*Caso nenhuma rota tem sido configurada um exception será disparada*/
		if (empty($dataRoute[$positionArray])) {
			throw new Web_requestException("Nenhuma rota, com nome (/{$url[2]}) configurada para o verbo HTTP usado na requisição");
		}

		/*Passando controller e método do array para variáveis separadas*/
		$controller = NAMESPACE_DEFAULT . "\\controller\\" . $dataRoute[$positionArray][1];
		$method = $dataRoute[$positionArray][2];

		if (!class_exists($controller)) {
			throw new Exception("Controller não existe");
		}

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

	public function restController()
	{
		return $this;
	}
	public function permitAll() {}
	public function authenticate() {}
}
