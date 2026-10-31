<?php

namespace App;

class CartItem
{
    private Product $product;
    private int $qty;

    public function __construct(Product $product, int $qty)
    {
        $this->qty = $qty;
        $this->product = $product;
    }

    public function getQty(): int
    {
        return $this->qty;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function subTotal(): float
    {
        return $this->product->price * $this->qty;
    }

    public function toArray(): array
    {
        return [
            "product" => [
                "id" => $this->product->id,
                "name" => $this->product->name,
                "price" => $this->product->price,
            ],
            "qty" => $this->qty,
        ];
    }

    public static function fromArray(array $data): CartItem
    {
        $productData = $data["product"];
        $product = new Product(
            $productData["id"],
            $productData["name"],
            $productData["price"]
        );

        return new self($product, $data["qty"]);
    }
}
