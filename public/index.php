<?php

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use TwigXray\Extension\XrayExtension;

$projectDir = \dirname(__DIR__);
require_once $projectDir.'/vendor/autoload.php';

$loader = new FilesystemLoader(['templates'], $projectDir);
$twig = new Environment($loader, [
    'cache' => $projectDir.'/var/cache/',
    'debug' => true,
]);
$twig->addExtension(new XrayExtension());

echo $twig->render('index.html.twig');
