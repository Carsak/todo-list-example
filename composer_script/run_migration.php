<?php
require_once __DIR__ . '/../vendor/autoload.php';

$database = new \App\Service\Database();

$migrationDir = __DIR__ . '/../migration/';
$files = scandir($migrationDir, SCANDIR_SORT_NONE);

foreach ($files as $file) {
    if ($file === '.' || $file === '..') {
        continue;
    }

    $sql = require_once($migrationDir . $file);

    $success = $database->connect()->query($sql)->execute();

    if ($success) {
        echo "Migration has been accepted " . print_r($sql, true);
    } else {
        echo 'Error during migration ' . print_r($sql, true);
    }
}

