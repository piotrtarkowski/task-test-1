<?php

namespace App\Command;

use App\Service\Data\Malfunction;
use App\Service\ErrorProcess;
use App\Service\Exception\ProcessDataException;
use App\Service\Process\InspectionProcess;
use App\Service\Process\MalfunctionProcess;
use App\Service\ProcessingDataService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Attribute\AsCommand;

class DataProcessCommand extends Command
{

    protected function configure(): void
    {
        $this
            ->setName('app:data:process')
            ->setDescription('process data from .json file')
            ->addArgument('file', InputArgument::REQUIRED, 'path to file')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $inputFile = $input->getArgument('file');
        $data = file_get_contents($inputFile);
        $jsonData = json_decode($data, true);

        $processingData = new ProcessingDataService();
        $inspectionService = $processingData->getProcessService(ProcessingDataService::INSPECTION);
        $malfunctionService = $processingData->getProcessService(ProcessingDataService::MALFUNCTION);

        foreach ($jsonData as $item) {
            try {

                $description = $item['description'];
                $phone = $item['phone'];
                $dueDate = $item['dueDate'];

                if (strpos($description, ProcessingDataService::INSPECTION_PROCESS_KEY) != false) {
                    $inspectionService->create($description, $phone, $dueDate);
                } else {
                    $malfunctionService->create($description, $phone, $dueDate);
                }

            } catch (ProcessDataException $e) {
                $error = $item;
                $error['errorMessage'] = $e->getMessage();
                $error['errorCode'] = $e->getCode();
                $processingData->getError()->addError($error);
            }
        }

        $malfunctionService->save();
        $inspectionService->save();

        $output->writeln('Przetworzono ' . $malfunctionService->count() . ' zgłoszeń awarii.');
        $output->writeln('Przetworzono ' . $inspectionService->count() . ' przeglądów.');
        $output->writeln('Zgłoszono ' . $processingData->getError()->countErrors() . ' błędów.');

        return Command::SUCCESS;
    }

}