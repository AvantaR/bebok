<?php

namespace Bebok\Parsers;

use Parsedown;

class MarkdownParser implements Parser
{
    public const VALID_EXTENSIONS = ['*.md', '*.markdown'];

    private Parsedown $parser;

    public function __construct()
    {
        $this->parser = new Parsedown();
    }

    public function toHtml(string $content): string
    {
        return $this->parser->text($content);
    }
}
