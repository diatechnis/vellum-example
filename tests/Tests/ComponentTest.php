<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Vellum\Contracts\Renderers\RenderInterface;
use Vellum\Path\SimpleClassPathResolver;
use Vellum\Path\SimpleTemplatePathResolver;
use VellumTwig\TwigRenderer;
use VellumTwig\VellumTwigExtension;

class ComponentTest extends TestCase
{
    /** @var string */
    private $templates_path;
    /** @var string */
    private $template_resolver;
    /** @var RenderInterface */
    private $renderer;
    /** @var \Twig\Environment */
    private $twig;

    private $page_title_input = [];
    private $page_to_load_input = [];
    private $classes_input = [];
    private $site_title_input = [];
    private $use_site_input = [];

    public function setUp()
    {
        parent::setUp();

        $this->setUpInputArrays();

        $this->renderer = require \dirname(__DIR__, 2) . '/bootstrap.php';
    }

    public function test_home_page_render()
    {
        $homepage = new \VellumExample\Widget\Page(
            ['page' => 'home'],
            $this->renderer
        );

        $html = $this->stripWhitespace($homepage->render());

        $this->assertContains('<h2>Homepage Content</h2>', $html);
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

        $this->assertContains($this->page_to_load_input, $inputs);
    }

    public function test_section_header_inputs()
    {
        $header = new \VellumExample\Section\Header();

        $inputs = $header->getAllInputs()->toArray();

        $page_title_input = $this->page_title_input;

        $page_title_input['description'] = 'The h1 title';

        $this->assertEquals($page_title_input, $inputs[0]);
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

    private function setUpInputArrays(): void
    {
        $this->page_title_input = [
            'name' => 'page_title',
            'description' => 'The title of the page',
            'type' => 'text',
            'hint' => '',
            'format' => 'string',
            'inputs' => [],
        ];

        $this->page_to_load_input = [
            'name' => 'page',
            'description' => 'The page to load',
            'type' => 'text',
            'hint' => '',
            'format' => 'string',
            'inputs' => [],
        ];

        $this->classes_input = [
            'name' => 'classes',
            'description' => 'CSS classes to add to the link',
            'type' => 'text',
            'hint' => '',
            'format' => 'string',
            'inputs' => [],
        ];
    }
}
