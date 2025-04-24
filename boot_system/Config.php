<?php

//Configurações de constantes da base de dados
define("HOST_DB", "localhost");
define("PORT_DB", 3306);
define("USER_DB", "root");
define("PASSWORD_DB", "");
define("DATABASE_DB", "db_login");

//Configurações de 
define("URL_padrao", "http://localhost:8007/Komeya/");

//Debug
define("MODE_DEVELOPER", true);

//Timezone
date_default_timezone_set('america/sao_paulo');

//Autoload, namespace para o sistema importar componetes
define("NAMESPACE_DEFAULT", "Komeya\\app");
