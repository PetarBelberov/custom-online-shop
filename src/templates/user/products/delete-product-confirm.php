<?php if (isset($productId)): ?>
    <h2>Delete Product Confirmation</h2>
    <p>Are you sure you want to delete this product?</p>
    <form action="/delete-product" method="post">
        <input type="hidden" name="product_id" value="<?php echo $productId; ?>">
        <button type="submit" name="confirm" value="yes">Yes</button>
        <button type="submit" name="confirm" value="no">No</button>
    </form>
<?php else: ?>
    <p>No product id found.</p>
<?php endif; ?>