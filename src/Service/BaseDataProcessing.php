<?php

namespace App\Service;

use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class BaseDataProcessing
{

    protected array $data = [];

    protected string $filename;

    protected Serializer $serializer;

    public function __construct(string $filename)
    {
        $this->filename = $filename;


        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];

        $this->serializer = new Serializer($normalizers, $encoders);
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function count(): int
    {
        return count($this->data);
    }

    public function saveToFile(array $data = []): void
    {
        try {
            $filesystem = new Filesystem();

            $filesystem->dumpFile('var/'.$this->filename, $this->serializer->serialize($data, 'json'));

        } catch (IOExceptionInterface $e) {
            throw $e;
        }
    }
}