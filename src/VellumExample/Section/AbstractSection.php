<?php

namespace VellumExample\Section;

use Tests\Inputs\Input;
use Vellum\Arguments\Arguments;
use Vellum\Contracts\Arguments\ArgumentsInterface;
use Vellum\Contracts\Components\ComponentInterface;
use Vellum\Contracts\Components\RenderableInterface;
use Vellum\Contracts\Inputs\InputsInterface;
use Vellum\Contracts\Renderers\RenderInterface;
use Vellum\Inputs\Inputs;
use Vellum\Inputs\TextInput;

abstract class AbstractSection implements RenderableInterface, ComponentInterface
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

    public function render(): string
    {
        return $this->renderer->render($this);
    }

    public function getArguments(): ArgumentsInterface
    {
        return new Arguments($this->data);
    }
}
