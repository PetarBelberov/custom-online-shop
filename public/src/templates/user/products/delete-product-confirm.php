<?php if (isset($productId)): ?>
    <form action="/delete-product" class="form" method="post">
        <h2>Delete Product Confirmation</h2>
        <p>Are you sure you want to delete this product?</p>
        <input type="hidden" name="product_id" value="<?php echo $productId; ?>">
        <button class="btn-primary" type="submit" name="confirm" value="yes">Yes</button>
        <button class="btn-primary" type="submit" name="confirm" value="no">No</button>
    </form>
<?php else: ?>
    <p>No product id found.</p>
<?php endif; ?>