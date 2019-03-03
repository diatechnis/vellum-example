<?php

namespace VellumExample\Page;

use Vellum\Contracts\FetchDataInterface;
use Vellum\Contracts\Inputs\InputsInterface;
use Vellum\Inputs\TextInput;

class Page extends AbstractPage implements FetchDataInterface
{
    private $pages = [
        'about' => 'About Page content',
        'contact' => 'Contact form here',
    ];

    public function getData()
    {
        $page = $this->getArguments()->get('page');

        if (! array_key_exists($page, $this->pages)) {
            throw new \InvalidArgumentException('404 Page not found.');
        }

        return ['content' => $this->pages[$page]];
    }

    public function getAllInputs(): InputsInterface
    {
        $inputs = parent::getAllInputs();

        $inputs->add(new TextInput('page', 'The page to load'));

        return $inputs;
    }
}
