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

        $this->templates_path = realpath(__DIR__ . '/../../') . '/templates';

        $this->template_resolver = new SimpleTemplatePathResolver('.twig');

        $this->twig = new Environment(
            new FilesystemLoader($this->templates_path),
            []
        );

        VellumTwigExtension::extendTwig(
            $this->twig,
            new SimpleClassPathResolver('\\VellumExample'),
            $this->template_resolver
        );

        $this->renderer = new TwigRenderer($this->twig, $this->template_resolver);
    }

    public function test_home_page_render()
    {
        //Imagine an HTTP Request Object
        $homepage = new \VellumExample\Page\Homepage([
                'page_title' => 'Super Awesome Homepage',
                'site_title' => 'Awesome Super Site',
                'use_site_as_h1' => 1
            ],
            $this->renderer
        );

        $html = $this->stripWhitespace($homepage->render());

        $this->assertContains('<h2>Homepage Content</h2>', $html);
    }

    public function test_about_page_render()
    {
        $page = new \VellumExample\Page\Page([
                'page_title' => 'Super About Page',
                'site_title' => 'Awesome Super Site',
                'page' => 'about'
            ],
            $this->renderer
        );

        $html = $this->stripWhitespace($page->render());

        $this->assertContains('About Page content', $html);
    }

    public function test_homepage_inputs()
    {
        $homepage = new \VellumExample\Page\Homepage();

        $inputs = $homepage->getAllInputs()->toArray();

        $this->assertContains($this->page_title_input, $inputs);

        $this->assertContains($this->site_title_input, $inputs);

        $this->assertContains($this->use_site_input, $inputs);
    }

    public function test_page_inputs()
    {
        $page = new \VellumExample\Page\Page();

        $inputs = $page->getAllInputs()->toArray();

        $this->assertContains($this->page_title_input, $inputs);

        $this->assertContains($this->site_title_input, $inputs);

        $this->assertContains($this->use_site_input, $inputs);
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

        $this->site_title_input = [
            'name' => 'site_title',
            'description' => 'The title of the site',
            'type' => 'text',
            'hint' => '',
            'format' => 'string',
            'inputs' => [],
        ];

        $this->use_site_input = [
            'name' => 'use_site_as_h1',
            'description' => 'Use the site title as the h1 tag?',
            'type' => 'select',
            'hint' => '',
            'format' => 'int',
            'inputs' => [
                ['name' => 0, 'value' => 'No'],
                ['name' => 1, 'value' => 'Yes'],
            ],
        ];
    }
}
