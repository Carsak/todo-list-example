<?php

namespace App\Controller;

abstract class BaseController
{
    protected function render(string $viewName, array $vars = []): string
    {
        if(!empty($vars)) {
            extract($vars);
        }

        $header = require_once __DIR__ . '/../View/header.php';
        $content = require_once __DIR__ . "/../View/{$viewName}.php";
        $footer = require_once __DIR__ . '/../View/footer.php';

        return $header . $content . $footer;
    }

    protected function removeSpecialChars(array $data): array
    {
        $newData = [];

        foreach ($data as $key => $value) {
            $newData[$key] = htmlentities(trim($value));
        }

        return $newData;
    }
}