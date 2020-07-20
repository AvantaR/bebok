<?php

namespace Bebok\Core;

use Bebok\Parsers\Parser;
use Parsedown;
use Bebok\Core\Template;
use Twig\Loader\FilesystemLoader;

class Converter
{
    private Parser $parser;
    private Template $template;

    public function __construct(Parser $parser, Template $template)
    {
        $this->parser = $parser;
        $this->template = $template;
    }

    public function run(): void
    {
        $links = [];
        $links[] = '<ul>';
        $files = scandir('input');
        foreach ($files as $file) {
            $fileInfo = pathinfo($file);
            if (in_array($fileInfo['extension'], $this->parser::VALID_EXTENSIONS)) {
                $file = file_get_contents('input/' . $file);

                $html = $this->parser->toHtml($file);

                file_put_contents("output/{$fileInfo['filename']}.html", $this->template->render($html));

                $links[] = '<li><a href="/' . $fileInfo['filename'] . '.html">' . $fileInfo['filename'] . '</a></li>';
            }
        }

        $links[] = '</ul>';

        file_put_contents('output/index.html', $links);
    }
}
