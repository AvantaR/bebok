<?php

namespace Bebok\Parsers;

interface Parser
{
    public function toHtml(string $content): string;
}
