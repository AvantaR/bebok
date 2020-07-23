<?php

namespace Bebok;

use Bebok\Core\Converter;
use Bebok\Core\Template;
use Bebok\Parsers\MarkdownParser;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;
use Twig\Environment as Twig;
use Twig\Loader\FilesystemLoader;

require 'vendor/autoload.php';

$finder = new Finder();
$filesystem = new Filesystem();

// Setting default parser
$parser = new MarkdownParser();

// Setting template engine
$twigLoader = new FilesystemLoader('templates');
$twig = new Twig($twigLoader);
$template = new Template($twig);

$converter = new Converter($finder, $filesystem, $parser, $template);
$converter->run();
