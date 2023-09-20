<?php

namespace App\Service\Data;

class Inspection
{

    private \DateTime $createdAt;

    private string $description;

    private string $type = 'przegląd';

    private string $date = '';

    private string $weekOfYear = '';

    private string $status = 'nowy';

    private string $recommend = '';

    private string $phone = '';

    public function __construct($description, $dueDate, $phone)
    {
        $this->createdAt = new \DateTime();
        $this->description = $description;
        $this->phone = $phone ?? '';

        if ($dueDate) {
            $date = new \DateTime($dueDate);
            $this->date = $date->format('Y-m-d');
            $this->weekOfYear = $date->format('W');
            $this->status = 'zaplanowano';
        }

    }

    public function getCreatedAt(): string
    {
        return $this->createdAt->format('Y-m-d');
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Inspection
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return Inspection
     */
    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @param string $date
     * @return Inspection
     */
    public function setDate(string $date): self
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return string
     */
    public function getWeekOfYear(): string
    {
        return $this->weekOfYear;
    }

    /**
     * @param string $weekOfYear
     * @return Inspection
     */
    public function setWeekOfYear(string $weekOfYear): self
    {
        $this->weekOfYear = $weekOfYear;
        return $this;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return Inspection
     */
    public function setStatus(string $status): self
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return string
     */
    public function getRecommend(): string
    {
        return $this->recommend;
    }

    /**
     * @param string $recommend
     * @return Inspection
     */
    public function setRecommend(string $recommend): self
    {
        $this->recommend = $recommend;
        return $this;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     * @return Inspection
     */
    public function setPhone(string $phone): self
    {
        $this->phone = $phone;
        return $this;
    }
}