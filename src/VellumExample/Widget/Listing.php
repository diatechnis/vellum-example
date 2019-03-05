<?php

namespace VellumExample\Widget;

use Vellum\Contracts\Components\AbstractComponent;
use Vellum\Contracts\DisplayTypes\DisplayTypesInterface;
use Vellum\Contracts\FetchDataInterface;
use Vellum\Contracts\Inputs\InputsInterface;
use Vellum\DisplayTypes\DisplayType;
use Vellum\DisplayTypes\DisplayTypes;
use Vellum\Inputs\Enums\Formats;
use Vellum\Inputs\Inputs;
use Vellum\Inputs\Options\Option;
use Vellum\Inputs\Options\Options;
use Vellum\Inputs\SelectOneInput;
use Vellum\Inputs\TextInput;

class Listing extends AbstractComponent implements FetchDataInterface
{
    public function getData()
    {
        $data = require DATA_DIR . '/list.php';

        $limit = $this->getArguments()->get('limit', 3);

        return ['items' => \array_slice($data, 0, $limit)];
    }

    public function createDisplayTypes(): DisplayTypesInterface
    {
        return new DisplayTypes(
            new DisplayType(
                'list',
                new Inputs(
                    new SelectOneInput(
                        'image_position',
                        'Float the image to the left or right?',
                        Formats::NUMBER,
                        new Options(
                            new Option('left', 0),
                            new Option('right', 1)
                        )
                    )
                ),
                'A simple text and image list',
                true
            ),
            new DisplayType(
                'card',
                new Inputs(),
                'Card UI'
            ),
            new DisplayType(
                'background-image',
                new Inputs(
                    new TextInput(
                        'text_color',
                        'A CSS hex-based color value',
                        '#000'
                    )
                ),
                'Information overlaid on an image background'
            )
        );
    }

    public function createInputs(): InputsInterface
    {
        return new Inputs(
            new TextInput(
                'limit',
                'Number of items to show (1-4)',
                3
            )
        );
    }
}
