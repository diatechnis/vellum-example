<?php

namespace VellumExample\Component;

use Vellum\Contracts\Components\AbstractComponent;
use Vellum\Contracts\Inputs\InputsInterface;
use Vellum\Inputs\Enums\Formats;
use Vellum\Inputs\Inputs;
use Vellum\Inputs\Options\Option;
use Vellum\Inputs\Options\Options;
use Vellum\Inputs\SelectOneInput;
use Vellum\Inputs\TextInput;

class Link extends AbstractComponent
{
    public function createInputs(): InputsInterface
    {
        return new Inputs(
            new TextInput('href', 'The value for the href attribute'),
            new TextInput('name', 'The displayed link text'),
            new SelectOneInput(
                'target',
                'The value for the target attribute',
                Formats::NUMBER,
                new Options(
                    new Option('Same window', 0),
                    new Option('New window', 1)
                ),
                0
            ),
            new TextInput('classes', 'CSS classes to add to the link')
        );
    }
}
