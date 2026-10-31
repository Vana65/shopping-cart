<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <h1 class="h3 mb-4">Add Product</h1>

                <?php if (!empty($_SESSION["product_error"])): ?>
                    <div class="alert alert-danger">
                        <?= htmlspecialchars($_SESSION["product_error"], ENT_QUOTES, "UTF-8") ?>
                    </div>
                    <?php unset($_SESSION["product_error"]); ?>
                <?php endif; ?>

                <form method="post" action="index.php?page=add-product">
                    <input type="hidden" name="action" value="create-product">

                    <div class="mb-3">
                        <label class="form-label" for="name">Product name</label>
                        <input class="form-control" id="name" name="name" type="text" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="price">Price</label>
                        <input class="form-control" id="price" name="price" type="number" min="0.01" step="0.01" required>
                    </div>

                    <button class="btn btn-primary" type="submit">Add Product</button>
                    <a class="btn btn-outline-secondary" href="index.php?page=home">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
