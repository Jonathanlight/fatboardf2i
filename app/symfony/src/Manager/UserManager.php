<?php

namespace App\Manager;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Services\MessageService;
use App\Services\PaginatorService;
use App\Services\PasswordService;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Symfony\Component\Form\Form;

class UserManager
{
    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * @var PasswordService
     */
    protected $passwordService;

    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * @var MessageService
     */
    protected $messageService;

    /**
     * @var PaginatorService
     */
    protected $paginatorService;

    /**
     * @param EntityManagerInterface $entityManager
     * @param PasswordService $passwordService
     * @param UserRepository $userRepository
     * @param MessageService $messageService
     * @param PaginatorService $paginatorService
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        PasswordService $passwordService,
        UserRepository $userRepository,
        MessageService $messageService,
        PaginatorService $paginatorService
    ) {
        $this->em = $entityManager;
        $this->passwordService = $passwordService;
        $this->userRepository = $userRepository;
        $this->messageService = $messageService;
        $this->paginatorService = $paginatorService;
    }

    /**
     * @param Form $form
     * @return PaginationInterface
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function collect(Form $form): PaginationInterface
    {
        return $this->paginatorService->paginate(
            $this->userRepository->search($form->getData()),
            PaginatorService::DEFAULT_LIMIT,
            PaginatorService::DEFAULT_PAGE
        );
    }

    /**
     * @param $username
     * @return User|null
     */
    public function loadByUsername($username): ?User
    {
        return $this->userRepository->findOneBy(['username' => $username]);
    }

    /**
     * @param User $user
     * @param string $password
     */
    public function setPassword(User $user, string $password): void
    {
        $user->setPassword($this->passwordService->encode($user, trim($password)));
        $this->em->flush();
    }

    /**
     * @param User $user
     */
    public function update(User $user): void
    {
        $user->setUpdated(new \DateTime());
        $this->em->flush();
        $this->messageService->addSuccess('message.flash.userUpdate');
    }

    /**
     * @param User $user
     */
    public function create(User $user): void
    {
        $pass = $this->passwordService->encode($user, $user->getPassword());
        $user->setPassword($pass);
        $user->setRole(User::ROLE_USER);
        $user->setUpdated(new \DateTime());
        $user->setCreated(new \DateTime());
        $this->em->persist($user);
        $this->em->flush();
        $this->messageService->addSuccess('message.flash.userCreate');
    }
}
