<?php

namespace VellumExample\Widget;

use Vellum\Contracts\Components\AbstractComponent;
use Vellum\Contracts\DisplayTypes\DisplayTypesInterface;
use Vellum\Contracts\FetchDataInterface;
use Vellum\Contracts\Inputs\InputsInterface;
use Vellum\DisplayTypes\DisplayTypes;
use Vellum\Inputs\Inputs;
use Vellum\Inputs\TextInput;

class Page extends AbstractComponent
{
    public function createInputs(): InputsInterface
    {
        $inputs = new Inputs();

        $inputs->add(new TextInput('page', 'The page to load'));

        return $inputs;
    }

    public function createDisplayTypes(): DisplayTypesInterface
    {
        return new DisplayTypes();
    }
}
