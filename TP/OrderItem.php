<?php

require_once "Product.php";

class OrderItem{
    private Product $product;
    private int $quantity;
    private float $priceAtPurchase;

    public function __construct(Product $product, int $quantity){
        $this->product = $product;
        $this->quantity = $quantity;
        $this->priceAtPurchase = $product->getPrice();
    }

public function getTotal(): float {
    return $this->priceAtPurchase * $this->quantity;
}

public function getProduct(): Product {
    return $this->product;
}

public function Quantity(): int {
    return $this->quantity;
}

}