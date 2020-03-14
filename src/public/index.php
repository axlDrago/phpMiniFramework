<?php
require_once '../engine/Core.php';

session_start();
$app = new Core;
$app->startApp();