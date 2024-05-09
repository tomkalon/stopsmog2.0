<?php

namespace App\Infrastructure\CLI;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:upload-directory:add',
    description: 'Creates directories for uploading files with www-data permissions',
)]
class CreateUploadDirectoryCommand extends Command
{
    public function __construct(
        private readonly string $targetDirectory
    )
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setHelp('This command creates the necessary upload directories with proper permissions');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $flag = false;

        $uploadsDir = $this->targetDirectory . '/';

        if (!file_exists($uploadsDir)) {
            mkdir($uploadsDir, 0755, true);
            $flag = true;
        }

        chown($uploadsDir, 'www-data');

        if ($flag) {
            $output->writeln('Upload directories created successfully.');
        } else {
            $output->writeln('Upload directories -> No changes were made.');
        }
        return Command::SUCCESS;
    }
}
