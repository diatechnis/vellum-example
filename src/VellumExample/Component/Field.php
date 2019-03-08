<?php

namespace VellumExample\Component;

use Vellum\Contracts\Components\AbstractComponent;
use Vellum\Contracts\DisplayTypes\DisplayTypesInterface;
use Vellum\Contracts\Inputs\InputsInterface;
use Vellum\DisplayTypes\DisplayType;
use Vellum\DisplayTypes\DisplayTypes;
use Vellum\Inputs\ArrayOfObjectsInput;
use Vellum\Inputs\Enums\Formats;
use Vellum\Inputs\Inputs;
use Vellum\Inputs\Options\Option;
use Vellum\Inputs\Options\Options;
use Vellum\Inputs\SelectOneInput;
use Vellum\Inputs\TextInput;

class Field extends AbstractComponent
{
    protected function createDisplayTypes(): ?DisplayTypesInterface
    {
        return new DisplayTypes(
            new DisplayType(
                'input',
                new Inputs(
                    new SelectOneInput(
                        'type',
                        'The inputs type attribute',
                        Formats::TEXT,
                        new Options(
                            new Option('text', 'text'),
                            new Option('email', 'email'),
                            new Option('phone', 'tel'),
                            new Option('date', 'date'),
                            new Option('hidden', 'hidden')
                        )
                    )
                ),
                'Use &lt;input&gt; as the field',
                true
            ),
            new DisplayType(
                'textarea',
                new Inputs(),
                'Use &lt;textarea&gt; as the field'
            ),
            new DisplayType(
                'select',
                new Inputs(
                    new ArrayOfObjectsInput(
                        'options',
                        'The &lt;option&gt;s for the select',
                        new Inputs(
                            new TextInput('name', 'The option name'),
                            new TextInput('value', 'The option value')
                        )
                    )
                ),
                'Use &lt;select&gt; as the field'
            )
        );
    }

    public function createInputs(): InputsInterface
    {
        return new Inputs(
            new TextInput('id', 'The field\'s id attribute'),
            new TextInput('classes', 'The field\'s class attribute'),
            new TextInput('label', 'The label element'),
            new TextInput('placeholder', 'An example value'),
            new TextInput('hint', 'Hint text'),
            new SelectOneInput(
                'required',
                'Whether this field is required or not',
                Formats::NUMBER,
                new Options(
                    new Option('Optional', 0),
                    new Option('Required', 1)
                )
            )
        );
    }
}
