<?php

class Model
{

    protected string $host;
    protected int $port;
    protected string $user;
    protected string $password;
    protected string $dataBase;
    protected static $connection = null;
    protected bool $debug;


    public function __construct()
    {
        $this->debug = true;
        $this->host = HOST_DB;
        $this->port = PORT_DB;
        $this->user = USER_DB;
        $this->password = PASSWORD_DB;
        $this->dataBase = DATABASE_DB;
        $this->getOrCreateDataBase();
    }


    public function getOrCreateDataBase()
    {
        try {
            if (self::$connection == null) {
                self::$connection = new PDO("mysql:host={$this->host}:{$this->port};dbname={$this->dataBase};charset=utf8", $this->user, $this->password);
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                self::$connection->setAttribute(PDO::ATTR_PERSISTENT, true);
                return self::$connection;
            }
            return self::$connection;
        } catch (PDOException $erro) {
            if (MODE_DEVELOPER) {

                $dataDebug = [
                    "typeErro" => "Falha ao tentar conectar com base de dados...",
                    "line" => $erro->getLine(),
                    "file" => $erro->getFile(),
                    "message" => $erro->getMessage()
                ];

                Debug::debugSQl($dataDebug);
            }
            return null;
        }
    }

    /* 
     *Fechar conexão com base de dados
    */
    public function closeConnection()
    {
        self::$connection = null;
    }

    /* 
     *Listar usuário 
    */
    public function list_all(string $tabela, string $colunas)
    {
        try {
            $sql = "SELECT $colunas FROM $tabela;";
            $prepare = self::$connection->prepare($sql);
            $prepare->execute();

            $arrayRegistros = [];
            while ($registro = $prepare->fetch(PDO::FETCH_ASSOC)) {
                array_push($arrayRegistros, $registro);
            }
            return $arrayRegistros;
        } catch (PDOException $erro) {
            if (MODE_DEVELOPER) {
                $dataDebug = [
                    "typeErro" => "Erro ao tentar listar os registros da tabela ({$tabela})",
                    "file" => $erro->getFile(),
                    "line" => $erro->getLine(),
                    "message" => $erro->getMessage()
                ];
                require_once("src/core/view_debug.php");
                die();
            }
        }
    }

    /* 
     *Listar usuário pelo id
    */
    public function read_by_id(string $tabela, string $colunas, array $id)
    {
        try {
            $sql = "SELECT $colunas FROM $tabela WHERE $id[0] = $id[1];";
            $prepare = self::$connection->prepare($sql);
            $prepare->execute();

            $arrayRegistros = [];
            while ($registro = $prepare->fetch(PDO::FETCH_ASSOC)) {
                array_push($arrayRegistros, $registro);
            }
            return $arrayRegistros;
        } catch (PDOException $erro) {
            if (MODE_DEVELOPER) {
                $dataDebug = [
                    "typeErro" => "Erro ao tentar listar os registros da tabela ({$tabela})",
                    "file" => $erro->getFile(),
                    "line" => $erro->getLine(),
                    "message" => $erro->getMessage()
                ];
                require_once("src/core/view_debug.php");
                die();
            }
        }
    }

    /* 
     *Inserir dados na base 
    */
    public function create(string $tabela)
    {
        try {
            $sql = "INSERT INTO $tabela () VALUES ();";
            $prepare = self::$connection->prepare($sql);
            //$prepare->execute($sql);

            $arrayRegistros = [];
            while ($registro = $prepare->fetch(PDO::FETCH_ASSOC)) {
                array_push($arrayRegistros, $registro);
            }
            return $this->columnString(["teste1" => 1, "teste2" => 2]);
        } catch (PDOException $erro) {
            if (MODE_DEVELOPER) {
                $dataDebug = [
                    "typeErro" => "Erro ao tentar inserir registros na tabela ({$tabela})",
                    "file" => $erro->getFile(),
                    "line" => $erro->getLine(),
                    "message" => $erro->getMessage()
                ];
                require_once("src/core/view_debug.php");
                die();
            }
        }
    }

    /* 
     *Excluir dados na base 
    */
    public function delete(string $tabela, array $id)
    {
        try {
            $sql = "DELETE FROM $tabela WHERE $id[0] = $id[1];";
            $prepare = self::$connection->prepare($sql);
            $prepare->execute();

            if ($prepare->rowCount() >= 1) {
                return true;
            }

            return false;
        } catch (PDOException $erro) {
            if (MODE_DEVELOPER) {
                $dataDebug = [
                    "typeErro" => "Erro ao tentar excluir o registro ({$id[0]} = {$id[1]}) da tabela ({$tabela})",
                    "file" => $erro->getFile(),
                    "line" => $erro->getLine(),
                    "message" => $erro->getMessage()
                ];
                require_once("src/core/view_debug.php");
                die();
            }
            return null;
        }
    }


    private function columnString(array $colunas)
    {
        $stringColunas = "";
        foreach ($colunas as $coluna => $key) {

            echo $key;
        }
    }
}
