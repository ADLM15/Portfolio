<?php
require_once "Customer.php";
require_once "OrderItem.php";

class Order {
    private int $id;
    private Customer $customer;
    private array $items = [];
    private string $status;
    private DateTime $createdAt;

    public function __construct(int $id, Customer $customer){
        $this->id = $id;
        $this->customer = $customer;
        $this->status = "pending";
        $this->createdAt = new DateTime();
    }

    public function addItem(Product $product, int $quantity): void {
        if ($quantity <= 0) {
            return;
        }

        if ($quantity > $product->getStock()) {
            echo "Stock insuffisant pour {$product->getName()}";
            return;
        }

        // Réduire le stock
        $product->reduceStock($quantity);

        $this->items[] = new OrderItem($product, $quantity);
    }

    public function removeItem(Product $product): void {
        foreach ($this->items as $key => $item) {
            if ($item->getProduct()->getId() === $product->getId()) {
                unset($this->items[$key]);
            }
        }
    }

    public function getTotal(): float {
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item->getTotal();
        }
        return $total;
    }

    public function validate(): bool {
        if (empty($this->items)) {
            echo "Commande vide";
            return false;
        }

        if (!$this->customer) {
            echo "Client manquant";
            return false;
        }

        $this->status = "paid";
        return true;
    }
}