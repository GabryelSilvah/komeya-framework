<?php

namespace Komeya\core\resources;

use Komeya\core\exceptions\Response_jsonException;
use Komeya\core\resources\Debug;


$debug;

function refresh($routeUrl)
{
    header("Refresh: 0");
}

function getInput(string $verbo_http = "post")
{
    $dataInput = [];
    switch ($verbo_http) {
        case "get":
            $dataInput = !empty($_GET) ? $_GET : null;
            break;
        case "post":
            $dataInput = !empty($_POST) ? $_POST : null;
            break;
        default:
            $dataInput = [false];
            break;
    }

    return $dataInput;
}

function input_by_name(string $name, string $verbo_http = "post")
{
    $dataInput = null;
    switch ($verbo_http) {
        case "get":
            $dataInput = !empty($_GET[$name]) ? $_GET[$name] : null;
            break;
        case "post":
            $dataInput = !empty($_POST[$name]) ? $_POST[$name] : null;
            break;
        default:
            $dataInput = null;
            break;
    }

    return $dataInput;
}
function view(string $view, array $data = [])
{
    $pathTemplate = "../../resources/templates/" . $view . ".php";
    if (!file_exists($pathTemplate)) {
        echo "Template não foi encontrado, verifique se o caminho do arquivo está correto.";
        die;
    }
    require_once($pathTemplate);
}

function redirect(string $route, array $data = [])
{
    $pathTemplate = URL_padrao . $route;

    header("Location: {$pathTemplate}");
}

/*Enviar dados no formato json*/
function response_json(string | object $data_response, int $status_code = 200)
{

    if (empty($data_response)) {
        throw new Response_jsonException("Nenhum dado passado para a response_json");
    }

    $response["status_code"] = 0;
    $response["message_code"] = null;

    switch ($status_code) {
        case 200:
            $response["status_code"] = 200;
            $response["message_code"] = "Ok";
            header("HTTP/1.1 200 Ok");
            break;
        case 201:
            $response["status_code"] = 201;
            $response["message_code"] = "Created";
            header("HTTP/1.1 201 Created");
            break;
        case 302:
            $response["status_code"] = 302;
            $response["message_code"] = "Found";
            header("HTTP/1.1 302 Found");
            break;
        case 400:
            $response["status_code"] = 400;
            $response["message_code"] = " Bad Request";
            header("HTTP/1.1 400 Bad Request");
            break;
        case 404:
            $response["status_code"] = 404;
            $response["message_code"] = "Not found";
            header("HTTP/1.1 404 Not found");
            break;
        case 500:
            $response["status_code"] = 500;
            $response["message_code"] = "Internal Server Error";
            header("HTTP/1.1 500 Internal Server Error");
            break;
        case 501:
            $response["status_code"] = 501;
            $response["message_code"] = "Not Implemented";
            header("HTTP/1.1 500 Not Implemented");
            break;

        case 502:
            $response["status_code"] = 502;
            $response["message_code"] = "Bad Gateway";
            header("HTTP/1.1 502  Bad Gateway");
            break;
        default:
            if (MODE_DEVELOPER) {
                Debug::debugException(["message" => "Status code ({$status_code}) não é válido ou não foi implementado"]);
                die;
            }
            $response["erro"] = "Erro no Servidor";
            break;
    }
    $response["dados"] = $data_response;
    echo json_encode($response);
}


function protecao_view(string $tipo_view, string $destino, $chave_session)
{
    switch ($tipo_view) {
        case "restrita":

            if (!isset($_SESSION[$chave_session]) && empty($_SESSION[$chave_session])) {
                header("Location: " . $destino);
                exit;
            }
            break;
        case "publica":
            if (isset($_SESSION[$chave_session]) && !empty($_SESSION[$chave_session])) {
                header("Location: " . $destino);
                exit;
            }
            break;
        default:
            break;
    }
}
