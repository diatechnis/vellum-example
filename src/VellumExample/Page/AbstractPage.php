<?php

namespace VellumExample\Page;

use Tests\Inputs\Input;
use Vellum\Arguments\Arguments;
use Vellum\Contracts\Arguments\ArgumentsInterface;
use Vellum\Contracts\Components\ComponentInterface;
use Vellum\Contracts\Components\RenderableInterface;
use Vellum\Contracts\Inputs\InputsInterface;
use Vellum\Contracts\Renderers\RenderInterface;
use Vellum\Inputs\Enums\Formats;
use Vellum\Inputs\Inputs;
use Vellum\Inputs\Options\Option;
use Vellum\Inputs\Options\Options;
use Vellum\Inputs\SelectOneInput;
use Vellum\Inputs\TextInput;

abstract class AbstractPage implements RenderableInterface, ComponentInterface
{
    /** @var RenderInterface */
    private $renderer;
    /** @var array */
    private $data;

    public function __construct(
        array $argument_data = [],
        RenderInterface $renderer = null
    ) {
        $this->renderer = $renderer;
        $this->data = $argument_data;
    }

    public function getAllInputs(): InputsInterface
    {
        return new Inputs(
            new TextInput('page_title', 'The title of the page'),
            new TextInput('site_title', 'The title of the site'),
            new SelectOneInput(
                'use_site_as_h1',
                'Use the site title as the h1 tag?',
                Formats::NUMBER,
                new Options(
                    new Option(0, 'No'),
                    new Option(1, 'Yes')
                ),
                0
            )
        );
    }

    public function render(): string
    {
        return $this->renderer->render($this);
    }

    public function getArguments(): ArgumentsInterface
    {
        return new Arguments($this->data);
    }
}
