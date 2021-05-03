<?php
namespace App\Controller;

use App\Model\ToDoItem;
use App\Service\TodoItemRepository;

class TodoController
{
    public function add()
    {
        $repository = new TodoItemRepository();
        $todoItem = $this->createItemFromPost();
        $repository->connect();
        $repository->add($todoItem);

        return $this->render('add');
    }

    public function index(): string
    {
        $repository = new TodoItemRepository();
        $repository->connect();
        $list = $repository->getList();

        return $this->render('index', ['todoList' => $list]);
    }

    private function render(string $viewName, $vars = []): string
    {
        if(!empty($vars)) {
            extract($vars);
        }

        $header = require_once __DIR__ . '/../View/header.php';
        $content = require_once __DIR__ . "/../View/todo/{$viewName}.php";
        $footer = require_once __DIR__ . '/../View/footer.php';

        return $header . $content . $footer;
    }

    private function createItemFromPost(): ToDoItem
    {
        $cleanedData = $this->removeSpecialChars($_POST);
        $item = new ToDoItem($cleanedData['username'], $cleanedData['user-email'], $cleanedData['description']);

        return $item;
    }

    private function removeSpecialChars(array $data): array
    {
        $newData = [];

        foreach ($data as $key => $value) {
            $newData[$key] = htmlentities(trim($value));
        }

        return $newData;
    }
}