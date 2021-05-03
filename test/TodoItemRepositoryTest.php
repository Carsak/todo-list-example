<?php
namespace Test;

use App\Model\ToDoItem;
use App\Service\TodoItemRepository;
use PHPUnit\Framework\TestCase;

class TodoItemRepositoryTest extends TestCase
{
    private static $dbh;

    public static function setUpBeforeClass(): void
    {
        self::$dbh = new \PDO('sqlite::memory:');
        self::$dbh->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        self::$dbh->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        self::$dbh->prepare('CREATE TABLE "todo_items" (
"id"	INTEGER,
"email"	TEXT NOT NULL,
"username"	TEXT NOT NULL,
"description"	TEXT NOT NULL,
"isEdited"	INTEGER DEFAULT 0,
"isDone"	INTEGER DEFAULT 0,
PRIMARY KEY("id" AUTOINCREMENT)
)')->execute();
;    }


    public static function tearDownAfterClass(): void
    {
        self::$dbh = null;
    }

    private array $fixtureForInsert = ['email' => 'alma@alma.kz', 'username' => 'alma', 'description' => 'some description'];

    public function testInsert() {
        $repository = new TodoItemRepository();
        $repository->connect(self::$dbh);
        $todo = new ToDoItem($this->fixtureForInsert['email'], $this->fixtureForInsert['username'], $this->fixtureForInsert['description']);
        $lastInsertId = $repository->add($todo);

        $array = self::$dbh->query("SELECT * FROM todo_items WHERE id = {$lastInsertId}")->fetch();

        $this->assertEquals($lastInsertId, $array['id']);
        $this->assertEquals($this->fixtureForInsert['email'], $array['email']);
        $this->assertEquals($this->fixtureForInsert['username'], $array['username']);
        $this->assertEquals($this->fixtureForInsert['description'], $array['description']);
    }

    public function testEdit() {
        $repository = new TodoItemRepository();
        $repository->connect(self::$dbh);

        $todo = new ToDoItem($this->fixtureForInsert['email'], $this->fixtureForInsert['username'], $this->fixtureForInsert['description']);
        $lastInsertId = $repository->add($todo);

        $repository->edit($lastInsertId, 'some other description', true);
        $array = self::$dbh->query("SELECT * FROM todo_items WHERE id = {$lastInsertId}")->fetch();

        $this->assertEquals($lastInsertId, $array['id'], 'Проверка идентичности');
        $this->assertEquals('some other description', $array['description'], "Проверка описания");
        $this->assertEquals(true, $array['isEdited'], "Поменялось ли описание");
        $this->assertEquals(true, $array['isDone'], "Поставлена ли метка о завершении задачи");
    }
}
