<?php
require_once("../Z_Moldes/exceptions/Web_requestExcepion.php");

class PointTest
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

	public static function startController(&$verbRouteHttp)
	{
		/*Recebendo indice do array que contém a controller a ser acessada*/
		$url = self::getUrl();
		$positionArray = self::findUrlInArray($verbRouteHttp, "/" . $url[2]);

		if (empty($verbRouteHttp[$positionArray])) {
			throw new Web_requestExcepion("Nenhuma rota configurada para esse verbo HTTP");
		}

		/*Passando controller e método do array para variáveis separadas*/
		$controller = $verbRouteHttp[$positionArray][1];
		$method = $verbRouteHttp[$positionArray][2];

		if (!class_exists($controller)) {
			throw new Exception("Controller $controller não existe");
		}

		if (!method_exists($controller, $method)) {
			throw new Exception("Método $method não existe na controller $controller");
		}

		/*Instanciando controller e chamando método*/
		$instacia = new $controller;
		$instacia->$method();
	}

	public function restController()
	{
		return $this;
	}
	public function permitAll() {}
	public function authenticate() {}
}
