<?php

namespace JLaso\HideMessage\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use JLaso\HideMessage\BaseCode;

class EncodeCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('encode')
            ->setDescription('Encode text')
            ->addOption('text',null, InputOption::VALUE_REQUIRED,'text file',null)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $start = microtime(true);

        $textFile = $input->getOption('text');
        if(!file_exists($textFile) || !is_readable($textFile)){
            $output->writeln("File $textFile does not exist or is not readable");
        }else{
            $text = file_get_contents($textFile);
            $text = str_replace(array("\n", "\r", "\r\n", "\n\r"), " ", $text);
            if(!preg_match("/(?<before>.*){{(?<source>.*?)}}(?<after>.*)/im", $text, $matches)){
                $output->writeln("File {$textFile} does not contain any {{sourceTextToHidden}} pattern");
            }else{
                $coder = new BaseCode();
                $source = $matches['source'];
                $result = $coder->encode($source, $matches['before'], $matches['after']);
                $output->writeln("Result from encoding {$source} is {$result}");
            }
        }

        $timeTaken = intval((microtime(true)-$start)*1000);
        $output->writeln("Process completed in {$timeTaken} msec");
    }
}
