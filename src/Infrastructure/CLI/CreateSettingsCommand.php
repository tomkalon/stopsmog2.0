<?php

namespace App\Infrastructure\CLI;

use App\Domain\Entity\Settings;
use App\Domain\Repository\SettingsRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:settings:add',
    description: 'Creates the settings entity with basic data',
)]
class CreateSettingsCommand extends Command
{
    public function __construct(
        private readonly SettingsRepositoryInterface $settingsRepository,
        private readonly EntityManagerInterface $em,
    )
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setHelp('This command creates the settings entity with basic data.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $settings = $this->settingsRepository->find('settings');
        if (!$settings) {
            $settings = new Settings();
            $this->em->persist($settings);
            $this->em->flush();
            $output->writeln('Settings created successfully.');
        } else {
            $output->writeln('Settings -> No changes were made.');
        }

        return Command::SUCCESS;
    }
}
