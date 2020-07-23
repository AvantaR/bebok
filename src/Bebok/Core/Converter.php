<?php

namespace Bebok\Core;

use Bebok\Parsers\Parser;
use Bebok\Core\Template;
use SplFileInfo;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;

class Converter
{
    private Finder $finder;
    private Filesystem $filesystem;
    private Parser $parser;
    private Template $template;
    private array $links = [];

    public function __construct(
        Finder $finder,
        Filesystem $filesystem,
        Parser $parser,
        Template $template
    ) {
        $this->finder = $finder;
        $this->filesystem = $filesystem;
        $this->parser = $parser;
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
        $html = $this->parser->toHtml($fileContent);
        $this->filesystem->dumpFile("output/{$file->getRelativePath()}/{$file->getBasename(".{$file->getExtension()}")}.html", $this->template->render($html));
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
        return $file->getRelativePath() ? $file->getRelativePath() . '/' :  null;
    }

    private function generateIndex(): void
    {
        $this->filesystem->dumpFile('output/index.html', $this->template->render(implode('', $this->links)));
    }
}
