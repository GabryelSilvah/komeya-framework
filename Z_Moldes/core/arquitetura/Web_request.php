<?php

class Web_request
{

	//Variáveis
	private static $rotasGet = [];
	private static $rotasPost = [];
	private static $rotasPut = [];
	private static $rotasDelete = [];
	public static $dataDebug = [];


	//Métodos para cada verbo http
	public static function get(string $rota, string $controller, string $metodo) {

		array_push(self::$rotasGet, self::add_rota($rota, $controller, $metodo));
	}

	public static function post(string $rota, string $controller, string $metodo) {
		array_push(self::$rotasPost, self::add_rota($rota, $controller, $metodo));
	}

	public static function put(string $rota, string $controller, string $metodo) {
		array_push(self::$rotasPut, self::add_rota($rota, $controller, $metodo));
	}

	public static function delete(string $rota, string $controller, string $metodo) {
		array_push(self::$rotasDelete, self::add_rota($rota, $controller, $metodo));
	}


	//Método para adicionar cada rota no Array de verbos http adequado
	private static function add_rota(string $rota, string $controller, string $metodo): array
	{

		$arrayRota = [
			"rota" => $rota,
			"controller" => $controller,
			"metodo" => $metodo
		];

		return $arrayRota;
	}


	//Chama o método que instancia uma controller e chama um método de acordo com o verbo http acionado
	public static function processar_rota() {

		$url = !empty($_SERVER["PATH_INFO"]) ? $_SERVER["PATH_INFO"] : "/";


		$metodoRequest = $_SERVER["REQUEST_METHOD"];

		switch ($metodoRequest) {

			case "GET":
				self::instaciarController(self::$rotasGet, $url);
				break;
			case "POST":
				self::instaciarController(self::$rotasPost, $url);
				break;
			case "PUT":
				self::instaciarController(self::$rotasPut, $url);
				break;
			case "DELETE":
				self::instaciarController(self::$rotasDelete, $url);
				break;
			default:
				self::$dataDebug = [
					"typeErro" => "O verbo HTTP ({$metodoRequest}) não está disponivel.",
					"file" => "EndPoint.php"
				];
				break;
		}
	}


	//Método responsável por instânciar a controller
	private static function instaciarController(array $rotas, string $url) {
		$controller = "";
		$metodo = "";

		foreach ($rotas as $endPoint) {

			if ($endPoint["rota"] == $url) {


				$controller = $endPoint["controller"];
				$metodo = $endPoint["metodo"];
			}
		}



		if (method_exists($controller, $metodo)) {
			$controller = new $controller;
			$controller->$metodo();
		} else {

			if (MODE_DEVELOPER) {
				$dataDebug = [
					"typeErro" => "O método/função ({$metodo}) informado na  controller ({$controller}) não exite.",
					"file" => "EndPoint.php"
				];
				
			}
			
			
		}
	}
}