

<h1 class="mb-4">Product List</h1>

<?php if (empty($products)): ?>
    <div class="alert alert-info">No products available at the moment.</div>
<?php else: ?>
    <div class="row g-4">
        <?php foreach ($products as $product): ?>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body d-flex flex-column">
                        <div class="product-image mb-3 text-center py-4 bg-light rounded fs-1">
                            
                        </div>
                        <h5 class="card-title fw-bold">
                            <?= htmlspecialchars($product->name, ENT_QUOTES, "UTF-8") ?>
                        </h5>

                        <p class="card-text text-muted">
                            Price:
                            <strong class="text-primary fs-5"><?= number_format($product->price, 2) ?> EGP</strong>
                        </p>

                        <form method="POST" action="index.php?page=home" class="mt-auto">
                            <input
                                type="hidden"
                                name="product_id"
                                value="<?= $product->id ?>"
                            >
                            <input type="hidden" name="action" value="add">
                            <button type="submit" class="btn btn-primary mt-3 w-100">
                                Add to Cart
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
