<?php
namespace Yaren\Chat;

use Yaren\Chat\Database\Model;

class Chat
{
    private $model;

    public function __construct(Model $model) {
        $this->model = $model;
    }

    public function sendMessage($message, $author) {
        $this->model->insertMessage($message, $author);
    }

    public function getMessages() {
        return $this->model->getMessages();
    }
}