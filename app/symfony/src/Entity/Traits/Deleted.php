<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

trait Deleted
{
    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $deleted;

    /**
     * @return \DateTimeImmutable|null
     */
    public function getDeleted(): ?\DateTimeImmutable
    {
        return $this->deleted;
    }

    /**
     * @param \DateTimeImmutable $deleted
     * @return self
     */
    public function setDeleted(\DateTimeImmutable $deleted): self
    {
        $this->deleted = $deleted;

        return $this;
    }
}