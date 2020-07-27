<?php

namespace Bebok;

use Bebok\Commands\BuildCommand;
use Bebok\Core\Converter;
use Bebok\Core\Template;
use Bebok\Parsers\MarkdownParser;
use Mni\FrontYAML\Parser as FrontMatter;
use Symfony\Component\Console\Application;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;
use Twig\Environment as Twig;
use Twig\Loader\FilesystemLoader;

require 'vendor/autoload.php';

$finder = new Finder();
$filesystem = new Filesystem();
$frontMatter = new FrontMatter();
// Setting up default parser
$parser = new MarkdownParser();

// Setting up template engine
$twigLoader = new FilesystemLoader('templates');
$twig = new Twig($twigLoader);
$template = new Template($twig);

// Setting up converter
$converter = new Converter($finder, $filesystem, $parser, $frontMatter, $template);

$app = new Application();
$app->add(new BuildCommand($converter));
$app->run();
