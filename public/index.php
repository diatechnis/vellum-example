<?php

$renderer = require dirname(__DIR__) . '/bootstrap.php';

$request = \Symfony\Component\HttpFoundation\Request::createFromGlobals();

$page = new \VellumExample\Layout\Main($request, $renderer);

try {
    echo $page->render();
    exit;
    return new \Symfony\Component\HttpFoundation\Response($page->render());
} catch (\Throwable $e) {
    echo $e->getMessage();
    exit;
    http_response_code(404);
    echo 'Not found';
    exit;
}

