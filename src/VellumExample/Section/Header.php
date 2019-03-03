<?php

namespace VellumExample\Section;

use Vellum\Contracts\Inputs\InputsInterface;
use Vellum\Inputs\Inputs;
use Vellum\Inputs\TextInput;

class Header extends AbstractSection
{
    public function getAllInputs(): InputsInterface
    {
        return new Inputs(
            new TextInput('page_title', 'The h1 title')
        );
    }
}
