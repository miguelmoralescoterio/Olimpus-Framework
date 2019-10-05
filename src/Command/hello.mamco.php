<?php
declare(strict_types=1);
namespace Olimpuss;
umask(0000);
/**
 * Controller Class for Home
 */
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Hello extends Command {
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:hello';

    protected function configure() {
        $this
        // the short description shown while running "php bin/console list"
        ->setDescription('Un Mensaje de Saludo.')

        // the full command description shown when running the command with
        // the "--help" option
        ->setHelp('Este es un mensaje de saludo');
    }

    protected function salutate() {
        return "Hello World!";
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        // outputs multiple lines to the console (adding "\n" at the end of each line)
        $output->writeln([
            'Hola Mundo',
            '============',
            '',
        ]);

        // the value returned by someMethod() can be an iterator (https://secure.php.net/iterator)
        // that generates and returns the messages with the 'yield' PHP keyword
        $output->writeln($this->salutate());

        // outputs a message followed by a "\n"
        $output->writeln('Whoa!');

        // outputs a message without adding a "\n" at the end of the line
        $output->write('You are about to ');
        $output->write('hello world developer.');
    }
}