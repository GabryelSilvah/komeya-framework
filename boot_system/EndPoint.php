<?php
require_once("./PointTest.php");
class EndPoint
{

	public function route()
	{

		PointTest::get("/", "usuarioController", "show")->restController()->permitAll();
		PointTest::get("/login", "usuarioController", "show")->restController()->permitAll();
		PointTest::get("/painel", "sistemaController", "show")->restController()->authenticate();


		PointTest::start_route();
	}
}
