<?php

namespace App\Services;

use App\Manager\LotsManager;

class RandomService
{
    /**
     * @var LotsManager
     */
    protected $lotsManager;

    /**
     * @param LotsManager $lotsManager
     */
    public function __construct(
        LotsManager $lotsManager
    ) {
        $this->lotsManager = $lotsManager;
    }

    /**
     * @return int
     */
    public function pourcentage(): int
    {
        $lots = $this->lotsManager->collect();
        $idLot = 0;

        foreach ($lots as $lot) {
            $aleatoire =  mt_rand(1,100);

            if ($aleatoire < $lot->getPourcentage()) {
                $idLot = $lot->getId();
            }
        }

        if ($idLot === 0) {
            return $this->pourcentage();
        }

        return $idLot;
    }
}
