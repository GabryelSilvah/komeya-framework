<?php

class Web_request
{
	private static $rotas_get = []; //Cria uma lista de rotas GET
	private static $rotas_post = []; //Cria uma lista de rotas POST
	private static $rotas_put = []; //Cria uma lista de rotas PUT
	private static $rotas_delete = []; //Cria uma lista de rotas DELETE


	public static function executar_rotas()
	{

		switch ($_SERVER["REQUEST_METHOD"]) {
			case "GET":
				self::instancia_controller(self::$rotas_get);
				break;
			case "POST":
				self::instancia_controller(self::$rotas_post);
				break;
			case "PUT":
				self::instancia_controller(self::$rotas_put);
				break;
			case "DELETE":
				self::instancia_controller(self::$rotas_delete);
				break;
			default:
				break;
		}
	}
	public static function get($rota, $controller, $metodo)
	{

		$rota_array = [$rota, $controller, $metodo];

		if ($_SERVER["REQUEST_METHOD"] == "GET") {

			$coluna_array = array_column(self::$rotas_get, 0); //Criar um array com as colunas [[0],[0]]

			if (!in_array($rota_array[0], $coluna_array)) { //Verificando se a rota passada já foi salva anteriomente
				array_push(self::$rotas_get, $rota_array); //Adiciona a rota no array de rotas
			}
		}
	}

	public static function post($rota, $controller, $metodo)
	{
		$rota_array = [$rota, $controller, $metodo];

		if ($_SERVER["REQUEST_METHOD"] == "POST") {

			$coluna_array = array_column(self::$rotas_post, 0); //Criar um array com as colunas [[0],[0]]

			if (!in_array($rota_array[0], $coluna_array)) {

				array_push(self::$rotas_post, $rota_array); //Add novas rotas na lista
			}
		}
	}

	public static function put($rota, $controller, $metodo)
	{
		$rota_array = [$rota, $controller, $metodo];

		if ($_SERVER["REQUEST_METHOD"] == "PUT") {

			$coluna_array = array_column(self::$rotas_put, 0); //Criar um array com as colunas [[0],[0]]

			if (!in_array($rota_array[0], $coluna_array)) {

				array_push(self::$rotas_put, $rota_array); //Add novas rotas na lista
			}
		}
	}


	public static function delete($rota, $controller, $metodo)
	{
		$rota_array = [$rota, $controller, $metodo];

		if ($_SERVER["REQUEST_METHOD"] == "DELETE") { //verificando o verbo http utilizado para fazer a requisição

			$coluna_array = array_column(self::$rotas_delete, 0); //Criar um array com as colunas [[0],[0]]

			if (!in_array($rota_array[0], $coluna_array)) {

				array_push(self::$rotas_delete, $rota_array); //Add novas rotas na lista
			}
		}
	}


	//Chamar a controller corresponde a rota passada
	public static function instancia_controller($rotaArmazenadas)
	{

		//pegando url
		$uri = $_SERVER["REQUEST_URI"];
		//Remover nome do site(plataforma_kevigo), apenas em ambiente de desenvolvimento
		$uri_replace = str_replace(NOME_SITE, "", $uri);

		//Substituir o simbolo de id pelo número na url para a rota possa ser comparada com a tora armazenada
		$uri_to_pesquisa = str_replace(self::number_in_url($uri), "{id}", $uri_replace);

		//Pegando o index do array onde está armazenado a rota
		$indice_array = Matriz::indice_na_matriz($uri_to_pesquisa, $rotaArmazenadas);

		//Verificar se rota está passando um id
		if (strpos($rotaArmazenadas[$indice_array][0], "{id}")) {
			//Substituir o simbolo {id} pelo número do id passado na url
			$rotaArmazenadas[$indice_array][0] = str_replace("{id}", self::number_in_url($uri), $rotaArmazenadas[$indice_array][0]);
		}

		//Separando o que é classe e o que é método
		$class =  $rotaArmazenadas[$indice_array][1];
		//echo "<pre>";
		//$class = new $class;

		$metodo = $rotaArmazenadas[$indice_array][2];

		//Se o método confiurado na rota existir na controller então a controller será instanciada chamando o método
		if (!method_exists($class, $metodo)) {

			//Instanciando classe e acessando método
			$Exceptions = new Exception_rota();
			$Exceptions->erro_rota("método ou controller não existe", $class, $metodo);

			exit();
		}

		//Instanciando classe e acessando método


		$controller =  new $class;
		$controller->$metodo();
	}

	//Pegar número {id} passado na url e retornar
	public static function number_in_url($url)
	{
		//Separar url em um array
		$array_url = explode("/", $url);

		//percorrer array
		for ($i = 0; $i < count($array_url); $i++) {
			//verificar se existe alguma posição que seja numerica
			//return valor numero
			if (is_numeric($array_url[$i])) {
				return $array_url[$i];
			}
		}
	}

	//Validar requisição feita ao servidor
	public static function validar_request()
	{
		header("Access-Control-Allow-origin:http://0.0.0.0/0");
		header("Access-Control-Allow-Methods:GET, POST, PUT,DELETE");
	}
}
