<?php

use PHPUnit\Framework\TestCase;

class PageTest extends TestCase
{
    private Page $page;

    protected function setUp(): void
    {
        $this->page = new Page(__DIR__ . '/../../site/templates/index.tpl');
    }

    public function testRenderInsertsData(): void
    {
        $html = $this->page->Render(['title' => 'My Title', 'content' => 'My Content']);

        $this->assertStringContainsString('<h1>My Title</h1>', $html);
        $this->assertStringContainsString('My Content', $html);
    }

    public function testRenderReplacesAllPlaceholders(): void
    {
        $html = $this->page->Render(['title' => 'T', 'content' => 'C']);

        $this->assertStringNotContainsString('{{', $html);
    }
}
