<h2>Create Product</h2>

<form action="/create-product" method="POST" enctype="multipart/form-data">
    <div>
        <label for="product_name">Product Name:</label>
        <input type="text" id="product_name" name="product_name" required>
    </div>
    <div>
        <label for="product_description">Product Description:</label>
        <textarea id="product_description" name="product_description" required></textarea>
    </div>
    <div>
        <label for="product_publication_date">Publication Date:</label>
        <input type="date" id="product_publication_date" name="product_publication_date" required>
    </div>
    <div>
        <label for="product_images">Product Images:</label>
        <input type="file" id="product_images" name="product_images[]" multiple>
    </div>
    <div id="image_preview_container"></div>
    <div>
        <button type="submit">Create Product</button>
    </div>
</form>
