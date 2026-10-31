<?php

namespace App;

use PDO;

class Product
{
    private int $id;
    private string $name;
    private float $price;

    public function __construct(int $id, string $name, float $price)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
    }

    public function __get(string $property): mixed
    {
        if ($property === 'id') {
            return $this->id;
        } elseif ($property === 'name') {
            return $this->name;
        } elseif ($property === 'price') {
            return $this->price;
        }

        return null;
    }
    public static function create(PDO $pdo, string $name, float $price):?Product
{
    $stmt = $pdo->prepare("INSERT INTO products (name, price) VALUES (?, ?)");

    $success = $stmt->execute([$name, $price]);
    if ($success) {
        $id = (int) $pdo->lastInsertId(); 
        return new self($id, $name, $price);
    }

    return null;
}
public static function getAll(PDO $pdo): array
{
    $stmt = $pdo->query("SELECT id, name, price FROM products");
    
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $products = [];
    foreach ($rows as $row) {
        $products[] = new self((int) $row['id'], $row['name'], (float) $row['price']);
    }
    return $products;
}
public static function findById(PDO $pdo, int $id): ?Product
{
    
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");

    
    $stmt->execute([$id]);

    
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($row) {
        return new self((int) $row['id'], $row['name'], (float) $row['price']);
    }

    
    return null;
}
}