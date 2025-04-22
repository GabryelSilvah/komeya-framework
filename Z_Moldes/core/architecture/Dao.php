<?php

namespace Komeya\core\architecture;

use Komeya\core\resources\Debug;
use PDO;
use PDOException;
use ReflectionClass;

class Dao
{
    protected string $host;
    protected int $port;
    protected string $user;
    protected string $password;
    protected string $dataBase;
    protected bool $debug;

    protected static $connection = null;

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
    /* 
     *Listar usuário 
    */
    public function findAll()
    {
        try {

            ///Pegando nome da model
            $reflectionRepository = new ReflectionClass($this::class);
            $annotationRepository =  $reflectionRepository->getAttributes("Repository");
            $model = $annotationRepository[0]->getArguments()[0];

            ///Pegando nome da tabela
            $reflection = new ReflectionClass("{$model}");
            $annotationTable =  $reflection->getAttributes("Table");
            $table =  $annotationTable[0]->getArguments()[0];




            //Criando script SQL
            $sql = "SELECT * FROM $table";
            $stm = self::$connection->prepare($sql);
            $stm->execute();

            //Pecorrendo cada registro encontrado e devolvendo para quem chamou o método
            $arrayRegistros = [];
            while ($registro = $stm->fetch(PDO::FETCH_ASSOC)) {
                array_push($arrayRegistros, $registro);
            }
            return $arrayRegistros;
        } catch (PDOException $erro) {
            if (MODE_DEVELOPER) {
                Debug::debugSQl("Falha, não foi possívl listar dados. ", $erro);
                die();
            }
            return null;
        }
    }

    /* 
     *Listar usuário pelo id
    */
    public function findById(int $id)
    {

        try {

            ///Pegando nome da model
            $reflectionRepository = new ReflectionClass($this::class);
            $annotationRepository =  $reflectionRepository->getAttributes("Komeya\core\annotetions\Repository");
            $model = $annotationRepository[0]->getArguments()[0];
            // echo "<pre>";
            // print_r($model);
            // die;

            ///Pegando nome da tabela
            $reflection = new ReflectionClass(NAMESPACE_DEFAULT . "\\model\\" . $model);
            $annotationTable =  $reflection->getAttributes("Komeya\core\annotetions\Table");
            $table =  $annotationTable[0]->getArguments()[0];


            //Pegando nome da propriedade que representa o ID na Model
            $nameId = "";
            $properties =  $reflection->getProperties();
            foreach ($properties as $properte) {

                if ($properte->getAttributes("Komeya\core\annotetions\Id") != null) {
                    $nameId = $properte->getName();
                    break;
                }
            }


            //Criando script SQL
            $sql = "SELECT * FROM $table WHERE {$nameId} = :id;";
            $stm = self::$connection->prepare($sql);
            $stm->bindValue("id", $id);
            $stm->execute();

            //Pecorrendo cada registro encontrado e devolvendo para quem chamou o método
            $arrayRegistros = [];
            while ($registro = $stm->fetch(PDO::FETCH_ASSOC)) {
                array_push($arrayRegistros, $registro);
            }
            return $arrayRegistros;
        } catch (PDOException $erro) {
            if (MODE_DEVELOPER) {
                Debug::debugSQl("Falha, não foi possívl listar dados. ", $erro);
                die();
            }
            return null;
        }
    }

    /* 
     *Inserir dados na base 
    */
    public function save(object $object)
    {
        try {
            //Pengando instância do objeto gerado
            $reflection = new ReflectionClass($object::class);
            //Pegando o nome da tabela inserida na annotation #table
            $annotation = $reflection->getAttributes("Komeya\core\annotetions\Table");
            $table = $annotation[0]->getArguments()[0];

            //Primeira bloco do comando
            $sql = "INSERT INTO {$table}(";
            //Segundo bloco do comando, valores para adicionar na tabela
            $value = "VALUES(";
            //Nome dos indentificadores que representam o dado que será adicionado após validação de injeção de sql
            $binds = [];
            //Percorrendo cada atributo da classe Model criada pelo usuário
            foreach ($reflection->getProperties() as $attribute) {
                //Adicionando cada nome da coluna existem na tabela do banco de dados
                $sql = $sql . $attribute->getName() . ", ";
                //Criando os indetificadores para representar o dado que será salvo na base de dados
                $value = $value . ":" . $attribute->getName() . ", ";
                //Adicionando em um array o nome dos indetificados que serão usados para substituir por dados reais
                array_push($binds, $attribute->getName());
            }
            //Eliminando o último caractere, vírgula
            $sql = trim(trim($sql), ",") . ") ";
            $sql = $sql . trim(trim($value), ",") . "); ";

            //Comandos SQL, executando
            $stm = self::$connection->prepare($sql);
            /*
            *Pegando os dados salvo em cada atributo declarado e instânciado com a classe Model
            */

            foreach ($binds as $bind) {
                $dataAttribute = $reflection->getProperty($bind);

                //Validando se variável/atribuito foi inicializada
                if (!$dataAttribute->isInitialized($object)) {
                    $stm->bindValue($bind, null);
                } else {
                    //Passando identificador e dado para substituir identificador
                    $stm->bindValue($bind, $dataAttribute->getValue($object));
                }
            }
            $stm->execute();

            return true;
        } catch (PDOException $erro) {
            if (MODE_DEVELOPER) {
                Debug::debugSQl("Falha, não foi possível inserir dados na tabela. ", $erro);
                die;
            }

            return null;
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
                Debug::debugSQl("Falha, não foi possívl excluir dados da tabela. ", $erro);
                die;
            }
            return null;
        }
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
                Debug::debugSQl("Falha, não foi possívl conectar realizar a conexão com a base de dadis. ", $erro);
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



    private function getKeyArray(array $arrayData)
    {
        $stringColunas = "";
        foreach ($arrayData as $data => $key) {

            echo $key;
        }
    }
}
