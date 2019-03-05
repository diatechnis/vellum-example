<?php

namespace VellumExample\Widget;

use Vellum\Contracts\Components\AbstractComponent;
use Vellum\Contracts\FetchDataInterface;
use Vellum\Contracts\Inputs\InputsInterface;
use Vellum\Inputs\Inputs;

class Navigation extends AbstractComponent implements FetchDataInterface
{
    private $github_api_link = 'https://github.com/diatechnis/vellum-example/blob/master/docs/api/';

    public function getData()
    {
        return [
            'items' => [
                [
                    'name' => 'Home',
                    'href' => '/'
                ],
                [
                    'name' => 'About',
                    'href' => '/about'
                ],
                [
                    'name' => 'Contact',
                    'href' => '/contact'
                ],
                [
                    'name' => 'Component APIs',
                    'items' => $this->getApiItems('component'),
                ],
                [
                    'name' => 'Section APIs',
                    'items' => $this->getApiItems('section'),
                ],
                [
                    'name' => 'Widget APIs',
                    'items' => $this->getApiItems('widget'),
                ]
            ]
        ];
    }

    public function getAllInputs(): InputsInterface
    {
        return new Inputs();
    }

    private function getApiItems(string $type): array
    {
        $directory = DOCS_DIR . '/api/' . $type;
        
        $files = array_diff(scandir($directory), ['..', '.']);

        $items = [];
        foreach ($files as $file) {
            $items[] = [
                'name' => ucfirst(str_replace('.json', '', $file)),
                'href' => $this->github_api_link . $type . '/' . $file,
                'target' => 1,
            ];
        }
        
        return $items;
    }
}
