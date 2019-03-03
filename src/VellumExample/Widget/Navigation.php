<?php

namespace VellumExample\Widget;

use Vellum\Contracts\FetchDataInterface;
use Vellum\Contracts\Inputs\InputsInterface;
use Vellum\Inputs\Inputs;

class Navigation extends AbstractWidget implements FetchDataInterface
{
    public function getData()
    {
        return [
            'items' => [
                [
                    'name' => 'Home',
                    'link' => '/'
                ],
                [
                    'name' => 'About',
                    'link' => '/about'
                ],
                [
                    'name' => 'Contact',
                    'link' => '/contact'
                ]
            ]
        ];
    }

    public function getAllInputs(): InputsInterface
    {
        return new Inputs();
    }
}
