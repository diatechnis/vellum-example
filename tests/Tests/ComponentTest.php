<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Vellum\Contracts\Renderers\RenderInterface;

class ComponentTest extends TestCase
{
    /** @var RenderInterface */
    private $renderer;

    public function setUp()
    {
        parent::setUp();

        $this->renderer = require \dirname(__DIR__, 2) . '/bootstrap.php';
    }

    public function test_home_page_render()
    {
        $homepage = new \VellumExample\Widget\Page(
            ['page' => 'home'],
            $this->renderer
        );

        $html = $this->stripWhitespace($homepage->render());

        $this->assertContains('<h1>Welcome to the Vellum Example</h1>', $html);
    }

    public function test_about_page_render()
    {
        $page = new \VellumExample\Widget\Page(
            ['page' => 'about'],
            $this->renderer
        );

        $html = $this->stripWhitespace($page->render());

        $this->assertContains('Vellum, the Component Library', $html);
    }

    public function test_page_inputs()
    {
        $page = new \VellumExample\Widget\Page();

        $inputs = $page->getAllInputs()->toArray();

        $this->assertContains([
            'name' => 'page',
            'description' => 'The page to load',
            'type' => 'text',
            'hint' => '',
            'format' => 'string',
            'inputs' => [],
        ], $inputs);
    }

    public function test_widget_navigation_inputs()
    {
        $nav = new \VellumExample\Widget\Navigation();

        $inputs = $nav->getAllInputs()->toArray();

        $this->assertEmpty($inputs);
    }

    private function stripWhitespace(string $html): string
    {
        return str_replace(["\n", '  '], '', $html);
    }
}
