<?php

namespace Bebok\Core;

use Twig\Environment as Twig;
use Twig\TemplateWrapper;

class Template
{

    private Twig $twig;
    private TemplateWrapper $template;

    public function __construct(Twig $twig)
    {
        $this->twig = $twig;
        $this->template = $twig->load('default.html');
    }

    public function load(string $name): void
    {
        $this->template = $this->twig->load($name);
    }

    public function render(string $content): string
    {
        return $this->template->render(['content' => $content]);
    }
}
