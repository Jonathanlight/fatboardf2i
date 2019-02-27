<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Services\PasswordService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    /**
     * @var PasswordService
     */
    protected $passwordService;

    /**
     * @param PasswordService $passwordService
     */
    public function __construct(PasswordService $passwordService)
    {
        $this->passwordService = $passwordService;
    }

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        // ROLE_USER
        $users = [
            [
                'username' => 'jonathan.kablan@gmail.com',
                'lastname' => 'jonathan',
                'firstname' => 'jonathan',
                'email' => 'jonathan.kablan@gmail.com',
                'password' => "bonjour",
                'roles' => "ROLE_USER",
                'picture' => 'user.jpg'
            ],
            [
                'username' => 'sarah@gmail.com',
                'lastname' => 'sarah',
                'firstname' => 'sarah',
                'email' => 'sarah@gmail.com',
                'password' => "bonjour",
                'roles' => "ROLE_USER",
            ],
            [
                'username' => 'louis@gmail.com',
                'lastname' => 'louis',
                'firstname' => 'louis',
                'email' => 'louis@gmail.com',
                'password' => "bonjour",
                'roles' => "ROLE_USER",
            ]
        ];

        foreach ($users as $key => $user) {
            $userSet = "emManager".$key;
            $$userSet = new User();
            $$userSet->setUsername($user['username']);
            $$userSet->setLastname($user['lastname']);
            $$userSet->setFirstname($user['firstname']);
            $$userSet->setEmail($user['email']);
            $$userSet->setPassword($this->passwordService->encode($$userSet, $user['password']));
            $$userSet->setRole($user['roles']);
            $$userSet->setCreated(new \DateTime());
            $$userSet->setUpdated(new \DateTime());
            $manager->persist($$userSet);
            $manager->flush();
        }
    }
}