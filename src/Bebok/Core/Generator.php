<?php

namespace Bebok\Core;

use Symfony\Component\Filesystem\Filesystem;

class Generator
{
    private Filesystem $filesystem;

    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    public function generateOutputFile(OutputFile $outputFile)
    {
        $this->filesystem->dumpFile(
            "output/{$outputFile->getPath()}/{$outputFile->getName()}.html",
            $outputFile->getTemplate()
        );
    }

    public function generateOutputIndex($template)
    {
        $this->filesystem->dumpFile('output/index.html', $template);
    }
}
