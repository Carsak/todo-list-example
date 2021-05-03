<?php
namespace App\Service;

use App\Model\ToDoItem;

class TodoItemRepository extends Database
{
    /**
     * Добавление задачи
     * @param ToDoItem $todo
     * @return int
     */
    public function add(ToDoItem $todo): int
    {
        $stmt = $this->pdo->prepare('INSERT INTO todo_items (email, username, description) VALUES (:email, :username, :description)');
        $success = $stmt->execute(['email' => $todo->getEmail(), 'username' => $todo->getUsername(), 'description' => $todo->getDescription()]);

        return $success ? $this->pdo->lastInsertId() : 0;
    }

    /**
     * Редактирование задачи
     * @param int $todoId
     * @param string $description
     * @param bool $isDone
     * @return bool
     */
    public function edit(int $todoId, string $description, bool $isDone): bool
    {
        $stmt = $this->pdo->prepare('UPDATE todo_items SET description = :description, isDone = :isDone, isEdited = :isEdited'
            . ' WHERE id = :todoId');
        $isEdited = $this->isDescriptionChanged($todoId, $description);

        return $stmt->execute(['todoId' => $todoId, 'description' => $description, 'isDone' => $isDone, 'isEdited' => $isEdited]);
    }

    /**
     * Изменил ли админ описание задачи
     * @param int $todoId
     * @param string $newDescription
     * @return bool
     */
    private function isDescriptionChanged(int $todoId, string $newDescription): bool
    {
        $stmt = $this->pdo->prepare("SELECT description FROM todo_items WHERE id = :todoId");
        $stmt->execute(['todoId' => $todoId]);
        $array = $stmt->fetch();

        return $newDescription !== $array['description'];
    }

    /**
     * Выборка всех задач
     * @return array
     */
    public function getList(): array
    {
        return $this->pdo->query('SELECT * FROM todo_items')->fetchAll();
    }
}