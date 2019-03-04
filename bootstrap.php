<?php

require_once __DIR__ . '/vendor/autoload.php';

$template_dir = __DIR__ . '/templates';

$request = \Symfony\Component\HttpFoundation\Request::createFromGlobals();

$twig = new \Twig\Environment(
    new \Twig\Loader\FilesystemLoader($template_dir),
    ['debug' => true]
);

$twig->addExtension(new \Twig\Extension\DebugExtension());

$template_resolver = new \Vellum\Path\SimpleTemplatePathResolver('.twig');

\VellumTwig\VellumTwigExtension::extendTwig(
    $twig,
    new \Vellum\Path\SimpleClassPathResolver('\\VellumExample'),
    $template_resolver
);

return new \VellumTwig\TwigRenderer($twig, $template_resolver);
