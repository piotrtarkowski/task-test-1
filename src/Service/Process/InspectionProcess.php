<?php

namespace App\Service\Process;

use App\Service\BaseDataProcessing;
use App\Service\Data\Inspection;

class InspectionProcess extends BaseDataProcessing
{

    protected array $data = [];

    public function __construct()
    {
        parent::__construct('przeglady.json');
    }

    public function create($description, $phone, $date)
    {

        if (!empty(array_filter($this->data, fn($item) => $item->getDescription() === $description ))) {
            return;
        }

        $inspection = new Inspection($description, $date, $phone);

        $this->data[] = $inspection;
    }

    public function count(): int
    {
        return count($this->data);
    }

    public function save(): void
    {
        $this->saveToFile($this->data);
    }
}