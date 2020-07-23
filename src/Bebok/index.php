<?php

namespace Bebok;

use Bebok\Core\Converter;
use Bebok\Core\Template;
use Bebok\Parsers\MarkdownParser;
use Twig\Environment as Twig;
use Twig\Loader\FilesystemLoader;

require 'vendor/autoload.php';

// Setting default parser
$parser = new MarkdownParser();

// Setting template engine
$twigLoader = new FilesystemLoader('templates');
$twig = new Twig($twigLoader);
$template = new Template($twig);

$converter = new Converter($parser, $template);
$converter->run();
