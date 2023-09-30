<div class="form">
    <h2>Create Product</h2>
    <form action="/create-product" method="POST" enctype="multipart/form-data">

        <div class="form-outline mb-4">
            <label class="form-label" for="product_name">Product Name:</label>
            <input type="text" id="product_name" name="product_name" class="form-control" required>
        </div>

        <div class="form-outline mb-4">
            <label class="form-label" for="product_description">Product Description</label>
            <textarea name="product_description" id="product_description" class="form-control" required ></textarea>
        </div>

        <div class="form-outline mb-4">
            <label class="form-label" for="product_publication_date">Publication Date:</label>
            <input type="date" id="product_publication_date" name="product_publication_date" required>
        </div>

        <div class="form-outline mb-4">
            <label class="form-label" for="product_images">Product Images:</label>
            <input type="file" id="product_images" name="product_images[]" multiple>
        </div>

        <div id="image_preview_container" class="form-outline mb-4">
            <?php include __DIR__ . './../../../partials/image-list.php'; ?>
        </div>

        <div id="image_preview_container"></div>
        <!-- Submit button -->
        <button type="submit" id="button" class="btn btn-primary btn-block mb-4">Create Product</button>
    </form>
</div>