<?php

namespace App\Service\Panier;

use App\Panier\ObjetPanier;
use Symfony\Component\HttpFoundation\RequestStack;

class PanierService
{
    protected $requestStack;
    protected $session;
    
    public function __construct(RequestStack $requestStack) {
        $this->requestStack = $requestStack;
    }

    public function add(int $id) {
        $panier = $this->requestStack->getSession()->get('panier', []);

        if(array_key_exists($id, $panier)) {
            $panier[$id]++;
        }
        else {
            $panier[$id] = 1;
        }

        $this->requestStack->getSession()->set('panier', $panier);
    }

    public function remove(int $id) {
        $panier = $this->requestStack->getSession()->get('panier', []);

        unset($panier[$id]);

        $this->requestStack->getSession()->set('panier', $panier);
    }

    public function decrement(int $id) {
        $panier = $this->requestStack->getSession()->get('panier', []);

        if(!array_key_exists($id, $panier)) {
            return;
        }

        if($panier[$id] === 1) {
            $this->remove($id);
            return;
        }

        $panier[$id]--;

        $this->requestStack->getSession()->set('panier', $panier);
    }

    public function getTotal(): int {
        $total = 0;

        return $total;
    }

    public function getPanierDetail(): array {
        $panierDetail = [];

        foreach($this->requestStack->getSession()->get('panier', []) as $id => $quantite) {
            $panierDetail[] = new ObjetPanier($quantite);
        }

        return $panierDetail;
    }
}