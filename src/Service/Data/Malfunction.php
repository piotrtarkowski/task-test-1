<?php

namespace App\Service\Data;

class Malfunction
{

    private \DateTime $createdAt;

    private string $description;

    private string $type = 'zgłoszenie awarii';

    private string $priority = 'normalny';

    private string $term = '';

    private string $status = 'nowy';

    private string $comment = '';

    private string $phone = '';

    public function __construct($description, $dueDate, $phone)
    {
        $this->createdAt = new \DateTime();
        $this->description = $description;
        $this->phone = $phone ?? '';

        if ($dueDate) {
            $date = new \DateTime($dueDate);
            $this->term = $date->format('Y-m-d');
            $this->status = 'termin';
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
     * @return Malfunction
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
     * @return Malfunction
     */
    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getPriority(): string
    {
        return $this->priority;
    }

    /**
     * @param string $priority
     * @return Malfunction
     */
    public function setPriority(string $priority): self
    {
        $this->priority = $priority;
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
     * @return Malfunction
     */
    public function setStatus(string $status): self
    {
        $this->status = $status;
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
     * @return Malfunction
     */
    public function setPhone(string $phone): self
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return string
     */
    public function getTerm(): string
    {
        return $this->term;
    }

    /**
     * @param string $term
     * @return Malfunction
     */
    public function setTerm(string $term): Malfunction
    {
        $this->term = $term;
        return $this;
    }

    /**
     * @return string
     */
    public function getComment(): string
    {
        return $this->comment;
    }

    /**
     * @param string $comment
     * @return Malfunction
     */
    public function setComment(string $comment): Malfunction
    {
        $this->comment = $comment;
        return $this;
    }


}