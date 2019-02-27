<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GameRepository")
 */
class Game
{
    const STATE_ONLINE = 'online';
    const STATE_OFFLINE = 'offline';
    const STATE_CANCELLED = 'cancelled';
    const STATE_DELETED = 'deleted';

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $status;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $deleted;

    /**
     * @var Admin
     *
     * @ORM\ManyToOne(targetEntity=Admin::class, cascade={"persist"}, inversedBy="game")
     * @ORM\JoinColumn(name="admin_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $admin;

    /**
     * @var ArrayCollection|Collection
     *
     * @ORM\OneToMany(targetEntity=Lots::class, mappedBy="game")
     */
    private $lots;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->lots = new ArrayCollection();
    }

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
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return null|string
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
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
     */
    public function setCreated(\DateTimeInterface $created): void
    {
        $this->created = $created;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getDeleted(): ?\DateTimeInterface
    {
        return $this->deleted;
    }

    /**
     * @param \DateTimeInterface $deleted
     * @return Game
     */
    public function setDeleted(\DateTimeInterface $deleted): self
    {
        $this->deleted = $deleted;

        return $this;
    }

    /**
     * Set admin
     *
     * @param Admin $admin
     */
    public function setAdmin(Admin $admin = null): void
    {
        $this->admin = $admin;
    }

    /**
     * Get admin
     *
     * @return Admin
     */
    public function getAdmin()
    {
        return $this->admin;
    }

    /**
     * Add lots
     *
     * @param Lots $lots
     */
    public function addLots(Lots $lots)
    {
        $this->lots[] = $lots;
    }

    /**
     * Remove lots
     *
     * @param Lots $lots
     */
    public function removeLots(Lots $lots)
    {
        $this->lots->removeElement($lots);
    }

    /**
     * Get lots
     *
     * @return Collection
     */
    public function getLots()
    {
        return $this->lots;
    }
}
