<?php
namespace App\Controller;

use App\Model\ToDoItem;
use App\Service\TodoItemRepository;

class TodoController extends BaseController
{
    public function add(): string
    {
        $repository = new TodoItemRepository();
        $todoItem = $this->createItemFromPost();
        $repository->connect();
        $repository->add($todoItem);

        return $this->render('todo/add');
    }

    public function index(): string
    {
        $repository = new TodoItemRepository();
        $repository->connect();
        $list = $repository->getList();

        $isAdmin = $_SESSION['admin']['isAuthorized'] ?? false;

        return $this->render('todo/index', ['todoList' => $list, 'isAdmin' => $isAdmin]);
    }

    private function createItemFromPost(): ToDoItem
    {
        $cleanedData = $this->removeSpecialChars($_POST);
        $item = new ToDoItem($cleanedData['username'], $cleanedData['user-email'], $cleanedData['description']);

        return $item;
    }
}
