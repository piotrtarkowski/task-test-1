<?php

namespace App\Service\Process;

use App\Service\BaseDataProcessing;
use App\Service\Data\Malfunction;

class MalfunctionProcess extends BaseDataProcessing
{

    protected array $data = [];

    public function __construct()
    {
        parent::__construct('zgloszenia_awarii.json');
    }

    public function create($description, $phone, $dueDate)
    {

        $malfunction = new Malfunction($description, $dueDate, $phone);

        if (strpos($description, 'bardzo pilne') !== false) {
            $malfunction->setPriority('krytyczny');
        } elseif(strpos($description, 'pilne') !== false) {
            $malfunction->setPriority('wysoki');
        }



        $this->data[] = $malfunction;
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