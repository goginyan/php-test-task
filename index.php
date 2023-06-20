<?php
require_once('Controllers/TextController.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    (new TextController())->create();
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    (new TextController())->index();
}