<?php

use PHPUnit\Framework\TestCase;

class DatabaseTest extends TestCase
{
    private string $path;
    private Database $db;

    // each test gets its own fresh database, so tests do not affect each other
    protected function setUp(): void
    {
        $this->path = tempnam(sys_get_temp_dir(), 'db');
        $this->db = new Database($this->path);
        $schema = file_get_contents(__DIR__ . '/../../sql/schema.sql');
        foreach (array_filter(array_map('trim', explode(';', $schema))) as $sql) {
            $this->db->Execute($sql);
        }
    }

    protected function tearDown(): void
    {
        unlink($this->path);
    }

    public function testCount(): void
    {
        $this->assertSame(3, $this->db->Count('page'));
    }

    public function testCreate(): void
    {
        $id = $this->db->Create('page', ['title' => 'Test Page', 'content' => 'Test Content']);

        $this->assertGreaterThan(0, (int)$id);
        $this->assertSame(4, $this->db->Count('page'));
    }

    public function testRead(): void
    {
        $row = $this->db->Read('page', 1);

        $this->assertSame('Page 1', $row['title']);
        $this->assertSame('Content 1', $row['content']);
    }

    public function testReadMissingRowReturnsFalse(): void
    {
        $this->assertFalse($this->db->Read('page', 999));
    }

    public function testUpdate(): void
    {
        $this->db->Update('page', 1, ['title' => 'After Update', 'content' => 'New content']);

        $this->assertSame('After Update', $this->db->Read('page', 1)['title']);
    }

    public function testDelete(): void
    {
        $this->db->Delete('page', 1);

        $this->assertFalse($this->db->Read('page', 1));
        $this->assertSame(2, $this->db->Count('page'));
    }

    public function testFetch(): void
    {
        $rows = $this->db->Fetch('SELECT * FROM page WHERE id = 1');

        $this->assertCount(1, $rows);
        $this->assertSame('Page 1', $rows[0]['title']);
    }
}
