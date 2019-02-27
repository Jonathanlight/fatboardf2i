<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TicketCaisseRepository")
 * @Serializer\ExclusionPolicy("all")
 */
class TicketCaisse
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Serializer\Expose()
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     * @Serializer\Expose()
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=50)
     * @Serializer\Expose()
     */
    private $reference;

    /**
     * @ORM\Column(type="string", length=255)
     * @Serializer\Expose()
     */
    private $commande;

    /**
     * @ORM\Column(type="float")
     */
    private $totalCommande;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return null|string
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @param string $code
     * @return TicketCaisse
     */
    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getReference(): ?string
    {
        return $this->reference;
    }

    /**
     * @param string $reference
     * @return TicketCaisse
     */
    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getCommande(): ?string
    {
        return $this->commande;
    }

    /**
     * @param string $commande
     * @return TicketCaisse
     */
    public function setCommande(string $commande): self
    {
        $this->commande = $commande;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getTotalCommande(): ?float
    {
        return $this->totalCommande;
    }

    /**
     * @param float $totalCommande
     * @return TicketCaisse
     */
    public function setTotalCommande(float $totalCommande): self
    {
        $this->totalCommande = $totalCommande;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    /**
     * @param \DateTimeInterface $created
     * @return TicketCaisse
     */
    public function setCreated(\DateTimeInterface $created): self
    {
        $this->created = $created;

        return $this;
    }
}
