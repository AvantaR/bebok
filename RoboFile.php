<?php

/**
 * This is project's console commands configuration for Robo task runner.
 *
 * @see http://robo.li/
 */
class RoboFile extends \Robo\Tasks
{
    public function build(): void
    {
        $this->_cleanDir('output');
        $this->_copy('templates/styles/github.css', 'output/style.css');
        $this->_exec('php src/Bebok/index.php');
    }

    public function start(): void
    {
        $this->_exec('php -S localhost:8181 -t output/');
    }
}