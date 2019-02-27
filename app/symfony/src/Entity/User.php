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
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
{
    use BaseUser;
    use UserInterfaceBase;
    Use Deleted;

    const ROLE_USER = "ROLE_USER";
    const ROLE_GERANT = "ROLE_GERANT";

    /**
     * @var ArrayCollection|Collection
     *
     * @ORM\OneToMany(targetEntity=LotUser::class, mappedBy="user")
     */
    private $lotUser;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->lotUser = new ArrayCollection();
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
