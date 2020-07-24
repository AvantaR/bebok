<?php

namespace Bebok\Commands;

use Bebok\Core\Converter;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class BuildCommand extends Command
{
    protected static $defaultName = 'bebok:build';

    private Converter $converter;

    public function __construct(Converter $converter)
    {
        $this->converter = $converter;

        parent::__construct();
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this->converter->run();
        return Command::SUCCESS;
    }
}
