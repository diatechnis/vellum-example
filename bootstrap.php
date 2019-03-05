<?php

require_once __DIR__ . '/vendor/autoload.php';

if (! defined('DATA_DIR')) {
    define('DATA_DIR', __DIR__ . '/data');
}
if (! defined('DOCS_DIR')) {
    define('DOCS_DIR', __DIR__ . '/docs');
}
if (! defined('PUBLIC_DIR')) {
    define('PUBLIC_DIR', __DIR__ . '/public');
}
if (! defined('SRC_DIR')) {
    define('SRC_DIR', __DIR__ . '/src');
}
if (! defined('TEMPLATES_DIR')) {
    define('TEMPLATES_DIR', __DIR__ . '/templates');
}
if (! defined('TESTS_DIR')) {
    define('TESTS_DIR', __DIR__ . '/tests');
}

$request = \Symfony\Component\HttpFoundation\Request::createFromGlobals();

$twig = new \Twig\Environment(
    new \Twig\Loader\FilesystemLoader(TEMPLATES_DIR),
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
