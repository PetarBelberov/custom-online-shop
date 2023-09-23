<?php if (isset($product)): ?>
    <div class="form">
        <h2>Edit Product</h2>
        <form action="/edit-product?id=<?php echo $product['id']; ?>" method="POST" enctype="multipart/form-data">

            <div class="form-outline mb-4">
                <label class="form-label" for="product_name">Product Name</label>
                <input type="text" name="product_name" id="product_name" class="form-control" value="<?php echo $product['name']; ?>" required/>
            </div>

            <div class="form-outline mb-4">
                <label class="form-label" for="product_description">Product Description</label>
                <textarea name="product_description" id="product_description" class="form-control" required ><?php echo $product['description']; ?></textarea>
            </div>

            <div class="form-outline mb-4">
                <label class="form-label" for="product_publication_date">Publication Date:</label>
                <input type="date" id="product_publication_date" name="product_publication_date" value="<?php echo $product['publication_date']; ?>" required>
            </div>

            <div class="form-outline mb-4">
                <label class="form-label" for="product_images">Product Images:</label>
                <input type="file" id="product_images" name="product_images[]" multiple>
            </div>

            <div id="image_preview_container" class="form-outline mb-4">
                <?php include __DIR__ . './../../../partials/image-list.php'; ?>
            </div>

            <!-- Submit button -->
            <button type="submit" id="button" class="btn btn-primary btn-block mb-4">Update Product</button>
        </form>
    </div>
<?php else: ?>
    <p>No product found.</p>
<?php endif; ?>
