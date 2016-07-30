<?php

namespace JLaso\HideMessage\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use JLaso\HideMessage\BaseCode;

class DecodeCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('decode')
            ->setDescription('Decode text')
            ->addOption('text',null, InputOption::VALUE_REQUIRED,'text file',null)
            ->addOption('code',null, InputOption::VALUE_REQUIRED,'code to decode',null)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $start = microtime(true);

        $code = $input->getOption('code');
        $textFile = $input->getOption('text');
        if(!file_exists($textFile) || !is_readable($textFile)){
            $output->writeln("File $textFile does not exist or is not readable");
        }else{
            $text = file_get_contents($textFile);
            $text = str_replace(array("\n", "\r", "\r\n", "\n\r"), " ", $text);
            $pos = strpos($text, $code);
            if(false === $pos){
                $output->writeln("File {$textFile} does not contain any {$code} pattern");
            }else{
                $before = substr($text, 0, $pos);
                $after = substr($text, $pos+strlen($code));
                $coder = new BaseCode();
                $result = $coder->decode($code, $before, $after);
                $output->writeln("Result from decoding {$code} is {$result}");
            }
        }

        $timeTaken = intval((microtime(true)-$start)*1000);
        $output->writeln("Process completed in {$timeTaken} msec");
    }
}
