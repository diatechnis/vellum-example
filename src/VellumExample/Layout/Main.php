<?php

namespace VellumExample\Layout;

use Symfony\Component\HttpFoundation\Request;
use Vellum\Arguments\Arguments;
use Vellum\Contracts\Arguments\ArgumentsInterface;
use Vellum\Contracts\Components\ComponentInterface;
use Vellum\Contracts\Components\RenderableInterface;
use Vellum\Contracts\FetchDataInterface;
use Vellum\Contracts\Inputs\InputsInterface;
use Vellum\Contracts\Renderers\RenderInterface;
use Vellum\Inputs\Inputs;

class Main implements ComponentInterface, FetchDataInterface, RenderableInterface
{
    /** @var \Vellum\Contracts\Renderers\RenderInterface */
    private $renderer;
    /** @var Request */
    private $request;

    private $pages = [
        'home' => 'Welcome to Vellum Example',
        'about' => 'About Vellum Example',
        'contact' => 'Contact Us'
    ];

    public function __construct(
        Request $request,
        RenderInterface $renderer = null
    ) {
        $this->request = $request;
        $this->renderer = $renderer;
    }

    public function getData()
    {
        $page = ltrim($this->request->getRequestUri(), '/');

        if ('' === $page) {
            $page = 'home';
        }

        if (! array_key_exists($page, $this->pages)) {
            throw new \InvalidArgumentException('404 Page not found.');
        }

        return [
            'page' => $page,
            'page_title' => $this->pages[$page]
        ];
    }

    public function getAllInputs(): InputsInterface
    {
        return new Inputs();
    }

    public function render(): string
    {
        return $this->renderer->render($this);
    }

    public function getArguments(): ArgumentsInterface
    {
        return new Arguments([]);
    }
}
