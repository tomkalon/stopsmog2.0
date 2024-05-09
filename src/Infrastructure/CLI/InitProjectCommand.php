<?php

namespace App\Infrastructure\CLI;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Exception\ExceptionInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:project:init',
    description: 'Configuration, first launch of the project.',
)]
class InitProjectCommand extends Command
{
    protected function configure(): void
    {
        $this
            ->setHelp('This command makes init project configuration.');
    }

    /**
     * @throws ExceptionInterface
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $application = $this->getApplication();

        $createSettingsRecord = $application->find('app:settings:add');
        $createSettingsRecord->run($input, $output);

        $createAdmin = $application->find('app:admin:add');
        $createAdmin->run($input, $output);


        $output->writeln('Initialization completed successfully.');
        return Command::SUCCESS;
    }
}
