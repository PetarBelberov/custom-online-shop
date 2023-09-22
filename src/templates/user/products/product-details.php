<?php if (isset($product) && isset($user)): ?>
    <h2><?php echo $product['name']; ?></h2>
    <p>Description: <?php echo $product['description']; ?></p>
    <p>Publication Date: <?php echo $product['publication_date']; ?></p>
    <p>Author: <?php echo $user['name']; ?></p>
    <p>Contact the seller: <?php echo $user['email']; ?></p>
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
<?php else: ?>
    <p>No product or user found.</p>
<?php endif; ?>