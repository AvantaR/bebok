<?php

namespace Bebok\Core;

use Bebok\Parsers\Parser;
use SplFileInfo;
use Symfony\Component\Finder\Finder;
use Mni\FrontYAML\Parser as FrontMatter;

class Converter
{
    private Finder $finder;
    private Generator $generator;
    private Parser $parser;
    private FrontMatter $frontMatter;
    private Template $template;
    private array $links = [];

    public function __construct(
        Finder $finder,
        Generator $generator,
        Parser $parser,
        FrontMatter $frontMatter,
        Template $template
    ) {
        $this->finder = $finder;
        $this->generator = $generator;
        $this->parser = $parser;
        $this->frontMatter = $frontMatter;
        $this->template = $template;
    }

    public function run(): void
    {
        $files = $this->getInputFiles();

        foreach ($files as $file) {
            $this->generateOutputFile($file);
            $this->appendLink($file);
        }

        $this->generateIndex();
    }

    private function generateOutputFile($file): void
    {
        $fileContent = $file->getContents();
        $document = $this->frontMatter->parse($fileContent, false);
        $yaml = $document->getYAML() ?? [];
        $html = $this->parser->toHtml($document->getContent());
        $template = $this->template->render(array_merge(['content' => $html], $yaml));

        $this->generator->generateOutputFile(new OutputFile($file, $template));
    }

    private function getInputFiles(): Finder
    {
        return $this->finder->files()->in('input')->name($this->parser::VALID_EXTENSIONS);
    }

    private function appendLink(SplFileInfo $file): void
    {
        $this->links[] = '<li><a href="/' . $this->getRelativePath($file) . $file->getBasename('.' . $file->getExtension()) . '.html">' . ucfirst($file->getBasename(".{$file->getExtension()}")) . '</a></li>';
    }

    private function getRelativePath($file): ?string
    {
        return $file->getRelativePath() ? $file->getRelativePath() . '/' : null;
    }

    private function generateIndex(): void
    {
        $data = [
            'title' => 'Test',
            'content' => '
                <h1>Welcome</h1>
                <ul>' . implode('', $this->links) . '</ul>
                '
        ];
        $template = $this->template->render($data);
        $this->generator->generateOutputIndex($template);
    }
}
