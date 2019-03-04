<?php

namespace VellumExample\Widget;

use Vellum\Contracts\Inputs\InputsInterface;
use Vellum\Inputs\Inputs;
use Vellum\Inputs\TextInput;

class Page extends AbstractWidget
{
    public function getAllInputs(): InputsInterface
    {
        $inputs = new Inputs();

        $inputs->add(new TextInput('page', 'The page to load'));

        return $inputs;
    }
}
