<?php if (isset($product) && isset($userDetails)): ?>
    <div id="product_details_page">
        <h2><?php echo $product['name']; ?></h2>
        <p>Description: <?php echo $product['description']; ?></p>
        <p>Publication Date: <?php echo $product['publication_date']; ?></p>
        <p>Author: <?php echo $userDetails['name']; ?></p>
        <div class="contact-the-seller">
            <h3>Contact the seller:</h3>
            <p>Email: <?php echo $userDetails['email']; ?></p>
            <?php if (!empty($userDetails['phone'])): ?>
                <p>Phone: <?php echo $userDetails['phone']; ?></p>
            <?php endif; ?>
        </div>
        <h3>Images:</h3>
        <?php if (!empty($imagePaths)): ?>
            <div class="image-gallery">
                <?php foreach ($imagePaths as $imagePath): ?>
                    <img src="<?php echo $imagePath; ?>" alt="Product Image">
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>No images available for this product.</p>
        <?php endif; ?>
        <?php if (isset($user) && $user['id'] === $product['user_id']): ?>
            <div>
                <a href="/edit-product?id=<?php echo $product['id']; ?>">Edit Product</a>
                <a href="/delete-product-confirm?id=<?php echo $product['id']; ?>">Delete Product</a>
            </div>
        <?php endif; ?>
    </div>
<?php else: ?>
    <p>No product or user found.</p>
<?php endif; ?>