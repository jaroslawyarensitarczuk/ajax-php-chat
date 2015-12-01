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

    public function insertMessage($message, $author) {
        $now = date('H:i:s');
        $query = $this->pdo->prepare("INSERT INTO messages(author, sendTime, message) VALUES(?, ?, ?)");
        $query->bindParam(1, $author);
        $query->bindParam(2, $now);
        $query->bindParam(3, $message);
        $query->execute();
    }

    public function getMessages() {
        $query = $this->pdo->query('SELECT * FROM messages ORDER BY ID DESC LIMIT 20');
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }
}
