<?php

declare(strict_types=1);

$root = dirname(__DIR__);
require_once $root . '/runtime/autoload.php';

$result = (new \AML\View\FileApplication($root . '/src/views'))->mount('/');
if (!$result instanceof \AML\View\PageResult || !str_contains($result->rootHtml(), '<main')) {
    throw new RuntimeException('The empty AML View home page did not render.');
}
if (!str_contains($result->rootHtml(), 'Minuteur')) {
    throw new RuntimeException('The timer did not render.');
}
if (!str_contains($result->rootHtml(), 'Démarrer') || !str_contains($result->rootHtml(), 'Réinitialiser')) {
    throw new RuntimeException('The timer controls did not render.');
}
if (!str_contains($result->rootHtml(), 'data-aml-toast')) {
    throw new RuntimeException('The timer completion Toast did not render.');
}

fwrite(STDOUT, "✓ AML View: empty home page renders" . PHP_EOL);
