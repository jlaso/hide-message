<?php

namespace JLaso\HideMessage\Command;

use JLaso\HideMessage\TransCode;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class TransCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('trans')
            ->setDescription('Trans text')
            ->addOption('text', null, InputOption::VALUE_REQUIRED, 'text to trans', null);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $start = microtime(true);

        $text = $input->getOption('text');
        $coder = new TransCode();
        $result = $coder->encode($text);
        $output->writeln("Result from encoding {$text} is {$result}");

        $timeTaken = intval((microtime(true) - $start) * 1000);
        $output->writeln("Process completed in {$timeTaken} msec");
    }
}
