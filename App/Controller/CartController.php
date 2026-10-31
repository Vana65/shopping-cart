<?php

namespace App\Controller;

use App\Cart;
use App\Product;
use PDO;

class CartController
{
    public static function handle(PDO $pdo): void
    {
        $cart = new Cart();

        $action = $_POST['action'] ?? $_GET['action'] ?? null;

        if ($action === null|| !in_array($action, ["add", "update", "remove"], true)|| ($_SERVER["REQUEST_METHOD"] ?? "") !== "POST") {
            return;
        }

        switch ($action) {
            case "add":
                if (($_SERVER["REQUEST_METHOD"] ?? '') === "POST") {
                    $productId = (int) ($_POST['product_id'] ?? 0);
                    $product = Product::findById($pdo, $productId);

                    if ($product !== null) {
                        $cart->addItem($product, 1);
                        $_SESSION['flash_message'] = "Added '{$product->name}' to cart successfully!";
                    }

                    header("Location: index.php?page=home");
                    exit;
                }
                break;

            case "remove":
                if (($_SERVER["REQUEST_METHOD"] ?? '') === "POST") {
                    $productId = (int) ($_POST['product_id'] ?? 0);
                    $cart->remove($productId);
                    header("Location: index.php?page=cart");
                    exit;
                }
                break;

            default:
                break;
        }
    }
}