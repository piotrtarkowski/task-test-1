<?php

namespace App\Service;

use App\Service\Process\InspectionProcess;
use App\Service\Process\MalfunctionProcess;

class ProcessingDataService
{

    const INSPECTION_PROCESS_KEY = 'przegląd';

    const INSPECTION = InspectionProcess::class;

    const MALFUNCTION = MalfunctionProcess::class;

    private ErrorProcess $errors;

    public function __construct()
    {
        $this->errors = new ErrorProcess();
    }

    public function getError(): ErrorProcess
    {
        return $this->errors;
    }

    public function getProcessService($className)
    {
        return new $className();
    }
}