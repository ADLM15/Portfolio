<?php
declare(strict_types=1);

require_once "Product.php";

class Cart {
    private array $items = []; 

    public function addProduct(Product $product, int $quantity = 1): void {
        if ($quantity <= 0) {
            return;
        }

        if (!$product->isAvailable()) {
            echo "Produit indisponible : {$product->getName()}";
            return;
        }

        if ($quantity > $product->getStock()) {
            echo "Stock insuffisant pour {$product->getName()}";
            return;
        }

        $id = $product->getId();

        if (!isset($this->items[$id])) {
            $this->items[$id] = 0;
        }

        // Vérifier si on dépasse le stock
        if ($this->items[$id] + $quantity > $product->getStock()) {
            echo "Impossible d'ajouter autant de {$product->getName()}";
            return;
        }

        $this->items[$id] += $quantity;
    }

    public function removeProduct(Product $product): void {
        $id = $product->getId();
        unset($this->items[$id]);
    }

    public function updateQuantity(Product $product, int $quantity): void {
        if ($quantity <= 0) {
            $this->removeProduct($product);
            return;
        }

        if ($quantity > $product->getStock()) {
            echo "Stock insuffisant pour {$product->getName()}";
            return;
        }

        $this->items[$product->getId()] = $quantity;
    }

    public function getItems(): array {
        return $this->items;
    }

    public function clear(): void {
        $this->items = [];
    }

    public function getTotal(array $products): float {
        $total = 0;

        foreach ($this->items as $id => $qty) {
            if (isset($products[$id])) {
                $total += $products[$id]->getPrice() * $qty;
            }
        }

        return $total;
    }
}
