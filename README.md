# Komeya

## Abount
<p>
  Framework de autoria própria para PHP. Mais importante que saber utilizar um framework é saber como é construído o mesmo. Melhor forma de tirar essa barreira abstrata é desenvolver seu próprio sistema framework. O komeya, inicialmente é sistema que seu principal recurso é o mapeamento de route url. Tendo por objetivo desenvolver mais módulos para gerenciamento de controller, model, security, services, crud SQL e configurações.

</p>

## Route exemple

Web_request::get("/user","UserController","show");
Web_request::post("/user","UserController","register");
Web_request::put("/user","UserController","edit");
Web_request::delete("/user","UserController","delete");

## Route security exemple

Web_request::get("/user","UserController","show")->autentication();
Web_request::post("/user","UserController","register")->permitAll();
Web_request::put("/user","UserController","edit")->autentication();
Web_request::delete("/user","UserController","delete")->autentication();

## Route  REST API exemple

Web_request::get("/user","UserController","show")->restApi()->autentication();
Web_request::post("/user","UserController","register")->restApi()->permitAll();
Web_request::put("/user","UserController","edit")->restApi()->autentication();
Web_request::delete("/user","UserController","delete")->restApi()->autentication();
