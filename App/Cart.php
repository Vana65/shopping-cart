<?php

namespace App;

class Cart
{
    private array $items = [];

    private const SESSION_KEY = "my_cart";

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION[self::SESSION_KEY]) && is_array($_SESSION[self::SESSION_KEY])) {
            $this->loadFromSession($_SESSION[self::SESSION_KEY]);
        }
    }

    private function loadFromSession(array $sessionData): void
    {
        foreach ($sessionData as $itemData) {
            if (is_array($itemData)) {
                $this->items[] = CartItem::fromArray($itemData);
            }
        }
    }

    private function saveToSession(): void
    {
        $data = [];

        foreach ($this->items as $item) {
            $data[] = $item->toArray();
        }

        $_SESSION[self::SESSION_KEY] = $data;
    }

    public function add(Product $product, int $qty = 1): void
    {
        $this->addItem($product, $qty);
    }

    public function addItem(Product $product, int $qty = 1): void
    {
        if ($qty < 1) {
            return;
        }

        foreach ($this->items as $index => $item) {
            if ($item->getProduct()->id === $product->id) {
                $this->items[$index] = new CartItem(
                    $product,
                    $item->getQty() + $qty
                );
                $this->saveToSession();
                return;
            }
        }

        $this->items[] = new CartItem($product, $qty);
        $this->saveToSession();
    }

    public function update(int $productId, int $qty): void
    {
        if ($qty < 1) {
            return;
        }

        foreach ($this->items as $index => $item) {
            if ($item->getProduct()->id === $productId) {
                $this->items[$index] = new CartItem($item->getProduct(), $qty);
                $this->saveToSession();
                return;
            }
        }
    }

    public function remove(int $productId): void
    {
        foreach ($this->items as $index => $item) {
            if ($item->getProduct()->id === $productId) {
                unset($this->items[$index]);
                $this->items = array_values($this->items);
                $this->saveToSession();
                return;
            }
        }
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function getTotal(): float
    {
        $total = 0.0;

        foreach ($this->items as $item) {
            $total += $item->subTotal();
        }

        return $total;
    }

    public function getQuantity(): int
    {
        $quantity = 0;

        foreach ($this->items as $item) {
            $quantity += $item->getQty();
        }

        return $quantity;
    }

    public function clear(): void
    {
        $this->items = [];
        $this->saveToSession();
    }
}
