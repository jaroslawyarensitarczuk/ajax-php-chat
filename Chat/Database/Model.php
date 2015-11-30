<?php
namespace Yaren\Chat\Database;

use Yaren\Core\JsonDecoder;

class Model {
    private $pdo;
    private $databaseConfig;

    public function __construct(JsonDecoder $jsonDecoder) {
        $config = $jsonDecoder->decodeJsonFile(__DIR__.'/config.json');
        $this->databaseConfig['host'] = $config->host;
        $this->databaseConfig['charset'] = $config->charset;
        $this->databaseConfig['db_name'] = $config->name;
        $this->databaseConfig['db_user'] = $config->user;
        $this->databaseConfig['db_password'] = $config->password;

        $dns = 'mysql:host='.$this->databaseConfig['host'].';dbname='.$this->databaseConfig['db_name']
                .';charset='.$this->databaseConfig['charset'].';';
        try {
            $this->pdo = new \PDO($dns, $this->databaseConfig['db_user'], $this->databaseConfig['db_password']);
        } catch(\PDOException $error) {
            echo $error->getMessage();
        }
    }
}