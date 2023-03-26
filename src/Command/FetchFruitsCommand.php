<?php

namespace App\Command;

use App\Service\FetchFruitsService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'fruits:fetch',
    description: 'Fetch all fruits from fruity vice web'
)]
class FetchFruitsCommand extends Command
{

    public function __construct(public readonly FetchFruitsService $fruitsService)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $result = $this->fruitsService->fetchFruits();

        if (! $result) {
            $io->success('Failed to get fruits from website');

            return Command::FAILURE;
        }

        $io->success('Finished getting & saving fruits successfully');

        return Command::SUCCESS;
    }
}