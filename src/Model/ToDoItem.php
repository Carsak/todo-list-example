<?php

namespace App\Model;

class ToDoItem
{
    private string $email;
    private string $username;
    private string $description;

    private bool $isEdited;
    private bool $isDone;

    public function __construct(
        string $email,
        string $username,
        string $description
    )
    {
        $this->email = $email;
        $this->username = $username;
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }
}