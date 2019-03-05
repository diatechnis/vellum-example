<?php

namespace VellumExample\Component;

use Vellum\Contracts\Components\AbstractComponent;
use Vellum\Contracts\Inputs\InputsInterface;
use Vellum\Inputs\Inputs;
use Vellum\Inputs\TextInput;

class Image extends AbstractComponent
{
    public function createInputs(): InputsInterface
    {
        return new Inputs(
            new TextInput('src', 'The src attribute'),
            new TextInput('alt', 'The alt attribute', ''),
            new TextInput('classes', 'CSS classes to add')
        );
    }
}
