<?php
namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use App\Entity\GenerateNumbers;

class FindMax extends Command
{
    protected static $defaultName = 'app:find-max';

    protected function configure()
    {
        $this
        ->addArgument('number', InputArgument::IS_ARRAY | InputArgument::REQUIRED, 'Numbers')
    ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        
        $number = $input->getArgument('number');
        $number = array_slice($number, 0, 10);
            foreach($number as &$iter){
                $iter = intval($iter);
            }

        $max = GenerateNumbers::findMax($number);
        $output->write('Output: ');
        $output->write(implode(' ',$max));
        return 0;
    }
}
