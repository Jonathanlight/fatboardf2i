<?php
/**
 * Created by PhpStorm.
 * User: Clarisse
 * Date: 18/10/2018
 * Time: 03:35
 */

namespace App\DataFixtures;

use App\Entity\Admin;
use App\Services\PasswordService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AdminFixtures extends Fixture
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
        // SUPER_ADMIN
        $admins = [
            [
                'username' => 'jonathan.kablan@gmail.com',
                'lastname' => 'jonathan',
                'firstname' => 'jonathan',
                'email' => 'jonathan.kablan@gmail.com',
                'password' => "bonjour",
                'roles' => "ROLE_SUPER_ADMIN",
                'picture' => 'user.jpg'
            ],
            [
                'username' => 'sarah@gmail.com',
                'lastname' => 'sarah',
                'firstname' => 'sarah',
                'email' => 'sarah@gmail.com',
                'password' => "bonjour",
                'roles' => "ROLE_SUPER_ADMIN",
            ],
            [
                'username' => 'louis@gmail.com',
                'lastname' => 'louis',
                'firstname' => 'louis',
                'email' => 'louis@gmail.com',
                'password' => "bonjour",
                'roles' => "ROLE_SUPER_ADMIN",
            ]
        ];

        foreach ($admins as $key => $admin) {
            $adminSet = "emManager".$key;
            $$adminSet = new Admin();
            $$adminSet->setUsername($admin['username']);
            $$adminSet->setLastname($admin['lastname']);
            $$adminSet->setFirstname($admin['firstname']);
            $$adminSet->setEmail($admin['email']);
            $$adminSet->setPassword($this->passwordService->encode($$adminSet, $admin['password']));
            $$adminSet->setRole($admin['roles']);
            $$adminSet->setCreated(new \DateTime());
            $$adminSet->setUpdated(new \DateTime());
            $manager->persist($$adminSet);
            $manager->flush();
        }
    }
}