<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="Public/style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <a class="brand" href="index.php?page=home">SHOP</a>
        <div class="nav-links">
            <a href="index.php?page=home">Home</a>
            <a href="index.php?page=add-product">Add Product</a>
            <a href="index.php?page=cart">
                Cart (<?= isset($cart) ? $cart->getQuantity() : 0 ?>)
            </a>
        </div>
    </nav>
    <main class="container">
        <?php if (!empty($_SESSION['flash_message'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($_SESSION['flash_message']) ?>
                <?php unset($_SESSION['flash_message']); ?>
            </div>
        <?php endif; ?>
