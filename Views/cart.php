<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Your Shopping Cart</h1>
    <a href="index.php?page=home" class="btn btn-outline-secondary">&larr; Continue Shopping</a>
</div>

<?php $cartItems = $cart->getItems(); ?>

<?php if (empty($cartItems)): ?>
    <div class="alert alert-info py-4 text-center">
        <h4>Your cart is empty!</h4>
        <p class="mb-3">Explore our products and add them to your cart.</p>
        <a href="index.php?page=home" class="btn btn-primary">Browse Products</a>
    </div>
<?php else: ?>
    <div class="table-responsive bg-white rounded shadow-sm p-4">
        <table class="table align-middle">
            <thead class="table-light">
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cartItems as $item): ?>
                    <?php $prod = $item->getProduct(); ?>
                    <tr>
                        <td>
                            <strong><?= htmlspecialchars($prod->name, ENT_QUOTES, "UTF-8") ?></strong>
                        </td>
                        <td><?= number_format($prod->price, 2) ?> EGP</td>
                        <td>
                            <form method="post" action="index.php?page=cart" class="d-flex gap-2">
                                <input type="hidden" name="action" value="update">
                                <input type="hidden" name="product_id" value="<?= $prod->id ?>">
                                <input class="form-control" type="number" name="qty" min="1" value="<?= $item->getQty() ?>">
                            </form>
                        </td>
                        <td><strong><?= number_format($item->subTotal(), 2) ?> EGP</strong></td>
                        <td>
                            <form method="post" action="index.php?page=cart">
                                <input type="hidden" name="action" value="remove">
                                <input type="hidden" name="product_id" value="<?= $prod->id ?>">
                                <button class="btn btn-sm btn-outline-danger" type="submit">Remove</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr class="table-light">
                    <td colspan="4" class="text-end fw-bold fs-5">Total:</td>
                    <td class="fw-bold fs-5 text-primary"><?= number_format($cart->getTotal(), 2) ?> EGP</td>
                </tr>
            </tfoot>
        </table>
    </div>
<?php endif; ?>
