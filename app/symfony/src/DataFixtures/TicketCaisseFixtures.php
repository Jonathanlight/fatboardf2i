<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use App\Entity\TicketCaisse;
use App\Services\PasswordService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class TicketCaisseFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $tickets = [];

        $menus = [
            'Big mac français - frite - coca',
            'Smile Burger - frite - sevenUp',
            'Menu salade - eau',
            'Menu mcFirst - frite - coca',
            'Menu happy meal',
            'Menu best of - orangina',
            'Menu maxi best of - sevenUp',
            'Doublez de viande - fromage - coca',
            'Bœuf ou poulet + fromage + ketchup',
            'Burger le king du Bœuf - fanta',
            'Maxi large Burger first - coca - cookie chocolat'
        ];

        for ($cpt = 0; $cpt <= 20; $cpt++) {
            $ticket = [
                'code' => rand(100000, 999000),
                'commande' => $menus[rand(0, count($menus) - 1)],
                'reference' => substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), -6),
                'totalCommande' => rand(18, 300)
            ];
            array_push($tickets, $ticket);
        }

        foreach ($tickets as $key => $ticket) {
            $ticketSet = "emManager".$key;
            $$ticketSet = new TicketCaisse();
            $$ticketSet->setCode($ticket['code']);
            $$ticketSet->setCommande($ticket['commande']);
            $$ticketSet->setReference($ticket['reference']);
            $$ticketSet->setTotalCommande($ticket['totalCommande']);
            $$ticketSet->setCreated(new \DateTime());
            $manager->persist($$ticketSet);
            $manager->flush();
        }
    }
}