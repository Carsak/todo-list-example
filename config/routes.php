<?php
use Pecee\SimpleRouter\SimpleRouter;

SimpleRouter::get('/', [\App\Controller\TodoController::class, 'index']);
SimpleRouter::post('/todo/add/', [\App\Controller\TodoController::class, 'add']);
SimpleRouter::post('/todo/edit/', [\App\Controller\TodoController::class, 'edit']);
