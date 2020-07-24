<?php

namespace Bebok\Parsers;

use Netcarver\Textile\Parser as Textile;

class TextileParser implements Parser
{
    public const VALID_EXTENSIONS = ['*.textile'];

    private Textile $parser;

    public function __construct()
    {
        $this->parser = new Textile();
    }

    public function toHtml(string $content): string
    {
        return $this->parser->parse($content);
    }
}
