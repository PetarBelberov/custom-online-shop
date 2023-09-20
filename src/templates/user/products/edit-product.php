<?php if (isset($product)): ?>
    <h2>Edit Product</h2>

    <form action="/edit-product?id=<?php echo $product['id']; ?>" method="POST" enctype="multipart/form-data">
        <div>
            <label for="product_name">Product Name:</label>
            <input type="text" id="product_name" name="product_name" value="<?php echo $product['name']; ?>" required>
        </div>
        <div>
            <label for="product_description">Product Description:</label>
            <textarea id="product_description" name="product_description" required><?php echo $product['description']; ?></textarea>
        </div>
        <div>
            <label for="product_publication_date">Publication Date:</label>
            <input type="date" id="product_publication_date" name="product_publication_date" value="<?php echo $product['publication_date']; ?>" required>
        </div>
        <div>
            <label for="product_images">Product Images:</label>
            <input type="file" id="product_images" name="product_images[]" multiple>
        </div>
        <div id="image_preview_container">
            <?php include __DIR__ . './../../../partials/image-list.php'; ?>
        </div>
        <div>
            <button type="submit">Update Product</button>
        </div>
    </form>
<?php else: ?>
    <p>No product found.</p>
<?php endif; ?>