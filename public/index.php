<?php
session_start();
require_once "../vendor/autoload.php";
require_once "../config/routes.php";

\Pecee\SimpleRouter\SimpleRouter::start();
