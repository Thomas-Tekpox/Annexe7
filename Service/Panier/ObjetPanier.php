<?php


namespace App\Service\Panier;

class ObjetPanier
{
    public $quantite;

    public function __construct(float $quantite)
    {
        $this->quantite = $quantite;
    }

    public function getTotal(): int {
        return $this->quantite;
    }
}