<?php

namespace App\Service;

class ErrorProcess extends BaseDataProcessing
{

    private array $errors = [];

    public function __construct()
    {
        parent::__construct('errors_process.json');
    }

    public function addError($data = []): void
    {
        $this->errors[] = $data;
    }

    public function countErrors(): int
    {
        return count($this->errors);
    }

    public function save(): void
    {
        $this->saveToFile($this->errors);
    }
}