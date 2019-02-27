<?php

namespace App\Entity;

use App\Entity\Traits\BaseUser;
use App\Entity\Traits\Deleted;
use App\Entity\Traits\UserInterfaceBase;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AdminRepository")
 */
class Admin implements UserInterface
{
    use BaseUser;
    use UserInterfaceBase;
    Use Deleted;

    const ROLE_SUPER_ADMIN = "ROLE_SUPER_ADMIN";

    /**
     * @var ArrayCollection|Collection
     *
     * @ORM\OneToMany(targetEntity=Game::class, mappedBy="admin")
     */
    private $game;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->game = new ArrayCollection();
    }

    /**
     * Add game
     *
     * @param Game $game
     *
     * @return Admin
     */
    public function addGame(Game $game)
    {
        $this->game[] = $game;

        return $this;
    }

    /**
     * Remove game
     *
     * @param Game $game
     */
    public function removeGame(Game $game)
    {
        $this->game->removeElement($game);
    }

    /**
     * Get game
     *
     * @return Collection
     */
    public function getGame()
    {
        return $this->game;
    }
}
