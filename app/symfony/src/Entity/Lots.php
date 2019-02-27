<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LotsRepository")
 */
class Lots
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $type;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbTotal;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbReste;

    /**
     * @ORM\Column(type="integer")
     */
    private $pourcentage;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $deleted;

    /**
     * @var Game
     *
     * @ORM\ManyToOne(targetEntity=Game::class, cascade={"persist"}, inversedBy="lots")
     * @ORM\JoinColumn(name="game_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $game;

    /**
     * @var ArrayCollection|Collection
     *
     * @ORM\OneToMany(targetEntity=LotUser::class, mappedBy="lots")
     */
    private $lotUser;

    /**
     * Lots constructor.
     */
    public function __construct()
    {
        $this->lotUser = new ArrayCollection();
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
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return Lots
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return int|null
     */
    public function getPourcentage(): ?int
    {
        return $this->pourcentage;
    }

    /**
     * @param int $pourcentage
     */
    public function setPourcentage(int $pourcentage): void
    {
        $this->pourcentage = $pourcentage;
    }

    /**
     * @return int|null
     */
    public function getNbTotal(): ?int
    {
        return $this->nbTotal;
    }

    /**
     * @param int $nbTotal
     */
    public function setNbTotal(int $nbTotal): void
    {
        $this->nbTotal = $nbTotal;
    }

    /**
     * @return int|null
     */
    public function getNbReste(): ?int
    {
        return $this->nbReste;
    }

    /**
     * @param int $nbReste
     */
    public function setNbReste(int $nbReste): void
    {
        $this->nbReste = $nbReste;
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
    public function getUpdated(): ?\DateTimeInterface
    {
        return $this->updated;
    }

    /**
     * @param \DateTimeInterface $updated
     */
    public function setUpdated(\DateTimeInterface $updated): void
    {
        $this->updated = $updated;
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
     */
    public function setDeleted(\DateTimeInterface $deleted): void
    {
        $this->deleted = $deleted;
    }

    /**
     * Set game
     *
     * @param Game $game
     */
    public function setGame(Game $game = null): void
    {
        $this->game = $game;
    }

    /**
     * Get game
     *
     * @return Game
     */
    public function getGame(): Game
    {
        return $this->game;
    }

    /**
     * Add lotUser
     *
     * @param LotUser $lotUser
     */
    public function addLotUser(LotUser $lotUser): void
    {
        $this->lotUser[] = $lotUser;
    }

    /**
     * Remove lotUser
     *
     * @param LotUser $lotUser
     */
    public function removeLotUser(LotUser $lotUser)
    {
        $this->lotUser->removeElement($lotUser);
    }

    /**
     * Get lotUser
     *
     * @return Collection
     */
    public function getLotUser(): Collection
    {
        return $this->lotUser;
    }

}
