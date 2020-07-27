<?php

namespace Bebok\Core;

use Symfony\Component\Finder\SplFileInfo;

class OutputFile
{
    private string $name;
    private string $path;
    private string $template;

    public function __construct(SplFileInfo $file, string $template)
    {
        $this->name = $file->getFilenameWithoutExtension();
        $this->path = $file->getRelativePath();
        $this->template = $template;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string|\Symfony\Component\Finder\string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @return string
     */
    public function getTemplate(): string
    {
        return $this->template;
    }

}
