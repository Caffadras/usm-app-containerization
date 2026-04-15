<?php

require_once __DIR__ . '/testframework.php';

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../modules/database.php';
require_once __DIR__ . '/../modules/page.php';

$testFramework = new TestFramework();

// test 1: check database connection
function testDbConnection() {
    global $config;
    try {
        $db = new Database($config["db"]["path"]);
        return assertExpression($db !== null, 'Database connection successful', 'Database connection failed');
    } catch (Exception $e) {
        error('Exception: ' . $e->getMessage());
        return false;
    }
}

// test 2: test count method
function testDbCount() {
    global $config;
    try {
        $db = new Database($config["db"]["path"]);
        $count = $db->Count("page");
        return assertExpression($count == 3, "Count returned {$count} (expected 3)", "Count failed, got {$count}");
    } catch (Exception $e) {
        error('Exception: ' . $e->getMessage());
        return false;
    }
}

// test 3: test create method
function testDbCreate() {
    global $config;
    try {
        $db = new Database($config["db"]["path"]);
        $id = $db->Create("page", ["title" => "Test Page", "content" => "Test Content"]);
        return assertExpression($id > 0, "Create returned ID {$id}", "Create failed, returned {$id}");
    } catch (Exception $e) {
        error('Exception: ' . $e->getMessage());
        return false;
    }
}

// test 4: test read method
function testDbRead() {
    global $config;
    try {
        $db = new Database($config["db"]["path"]);
        $data = $db->Read("page", 1);
        return assertExpression(
            isset($data['title']) && $data['title'] === 'Page 1',
            "Read returned correct title: {$data['title']}",
            "Read failed or returned incorrect data"
        );
    } catch (Exception $e) {
        error('Exception: ' . $e->getMessage());
        return false;
    }
}

// test 5: test update method
function testDbUpdate() {
    global $config;
    try {
        $db = new Database($config["db"]["path"]);
        $id = $db->Create("page", ["title" => "Before Update", "content" => "Old content"]);
        $db->Update("page", $id, ["title" => "After Update", "content" => "New content"]);
        $data = $db->Read("page", $id);
        return assertExpression(
            $data['title'] === 'After Update',
            "Update successful: {$data['title']}",
            "Update failed, title is: {$data['title']}"
        );
    } catch (Exception $e) {
        error('Exception: ' . $e->getMessage());
        return false;
    }
}

// test 6: test delete method
function testDbDelete() {
    global $config;
    try {
        $db = new Database($config["db"]["path"]);
        $id = $db->Create("page", ["title" => "Delete Me", "content" => "To be deleted"]);
        $db->Delete("page", $id);
        $data = $db->Read("page", $id);
        return assertExpression($data === false, "Delete successful, record no longer exists", "Delete failed, record still exists");
    } catch (Exception $e) {
        error('Exception: ' . $e->getMessage());
        return false;
    }
}

// test 7: test fetch method
function testDbFetch() {
    global $config;
    try {
        $db = new Database($config["db"]["path"]);
        $rows = $db->Fetch("SELECT * FROM page WHERE id = 1");
        return assertExpression(
            is_array($rows) && count($rows) > 0 && $rows[0]['id'] == 1,
            "Fetch returned " . count($rows) . " row(s) with correct data",
            "Fetch failed or returned unexpected data"
        );
    } catch (Exception $e) {
        error('Exception: ' . $e->getMessage());
        return false;
    }
}

// test 8: test page render method
function testPageRender() {
    $page = new Page(__DIR__ . '/../templates/index.tpl');
    $data = ["title" => "Test Title", "content" => "Test Content"];
    $rendered = $page->Render($data);
    return assertExpression(
        strpos($rendered, "Test Title") !== false && strpos($rendered, "Test Content") !== false,
        "Page rendered successfully with correct data",
        "Page render failed or data not substituted"
    );
}

// test 9: test page render replaces all placeholders
function testPageRenderPlaceholders() {
    $page = new Page(__DIR__ . '/../templates/index.tpl');
    $data = ["title" => "My Title", "content" => "My Content"];
    $rendered = $page->Render($data);
    $noLeftovers = strpos($rendered, '{{') === false;
    return assertExpression(
        $noLeftovers,
        "Page render replaced all placeholders",
        "Page render left unreplaced placeholders in output"
    );
}

// add tests
$testFramework->add('Database connection', 'testDbConnection');
$testFramework->add('table count', 'testDbCount');
$testFramework->add('data create', 'testDbCreate');
$testFramework->add('data read', 'testDbRead');
$testFramework->add('data update', 'testDbUpdate');
$testFramework->add('data delete', 'testDbDelete');
$testFramework->add('data fetch', 'testDbFetch');
$testFramework->add('page render', 'testPageRender');
$testFramework->add('page render placeholders', 'testPageRenderPlaceholders');

// run tests
$testFramework->run();

echo $testFramework->getResult();

