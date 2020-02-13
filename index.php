<?php

use app\MantisBT;

require_once __DIR__ . '/vendor/autoload.php';

// Read environment variables
$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();


$api = new MantisBT();

// Get Request
$api->getIssuesForProject(1);

// Post Request for create issue
$api->createIssue([
    "summary" => "This is test issue",
    "description" => "This is test issue",
    "category" => [
        'id' => 1
    ],
    "project" => [
        "id" => 1,
    ],
]);


