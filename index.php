<?php

use App\Database;
use App\Product;
use App\Cart;
use App\Controller\CartController;

require_once __DIR__ . "/Vendor/autoload.php";
$config = require_once __DIR__ . "/Config/database.php";

// Initialize Database connection
$db = Database::getInstance($config);
$pdo = $db->getConnection();

// Initialize the shopping cart
$cart = new Cart();
CartController::handle($pdo);

$page = $_GET['page'] ?? 'home';

if ($page === "add-product" && ($_SERVER["REQUEST_METHOD"] ?? "") === "POST") {
    $name = trim($_POST["name"] ?? "");
    $price = (float) ($_POST["price"] ?? 0);

    if ($name === "" || $price <= 0) {
        $_SESSION["product_error"] = "Enter a valid product name and price.";
    } elseif (Product::create($pdo, $name, $price) === null) {
        $_SESSION["product_error"] = "Unable to add the product.";
    } else {
        $_SESSION["flash_message"] = "Product added successfully.";
        header("Location: index.php?page=home");
        exit;
    }
}

require_once __DIR__ . "/Views/Layouts/header.php";

switch ($page) {
    case "home":
        $products = Product::getAll($pdo);
        require_once __DIR__ . "/Views/home.php";
        break;
        
    case "cart":
        require_once __DIR__ . "/Views/cart.php";
        break;

    case "add-product":
        require_once __DIR__ . "/Views/add-product.php";
        break;

    default:
        require_once __DIR__ . "/Views/home.php";
        break;
}

require_once __DIR__ . "/Views/Layouts/footer.php";
