<?php

require_once __DIR__ . '/modules/database.php';
require_once __DIR__ . '/modules/page.php';

require_once __DIR__ . '/config.php';

$dsn = "mysql:host={$config['db']['host']};dbname={$config['db']['database']};charset=utf8";

$db = new Database($dsn, $config['db']['username'], $config['db']['password']);

$page = new Page(__DIR__ . '/templates/index.tpl');

// bad idea, not recommended
$pageId = $_GET['page'] ?? 1;

$data = $db->Read("page", $pageId);

if (!$data) {
    http_response_code(404);
    echo "Page not found.";
    exit;
}

echo $page->Render($data);

