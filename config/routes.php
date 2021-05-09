<?php
use Pecee\SimpleRouter\SimpleRouter;

SimpleRouter::get('/', [\App\Controller\TodoController::class, 'index']);
SimpleRouter::post('/todo/add/', [\App\Controller\TodoController::class, 'add']);
SimpleRouter::post('/todo/edit/', [\App\Controller\TodoController::class, 'edit']);
SimpleRouter::match(['get'], '/admin/signin/', [\App\Controller\AdminController::class, 'signIn']);
SimpleRouter::match(['post'], '/admin/authorize/', [\App\Controller\AdminController::class, 'authorize']);
