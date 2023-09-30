<?php if (isset($product) && isset($userDetails)): ?>
<div class="product-details">
    <div class="card">
    <div class="container-fliud">
        <div class="wrapper row">
            <div id="product_details_page" class="details col-md-12">
                <h3 class="product-title"><?php echo $product['name']; ?></h3>
                <p class="product-description"><?php echo $product['description']; ?></p>
                <h4 class="publication-date">Publication Date: <span class="sky-blue-p"><?php echo $product['publication_date']; ?></span></h4>
                <p class="author"><strong>Author</strong> <?php echo $userDetails['name']; ?></p>
                <div class="contact-the-seller">
                    <h3>Contact the seller:</h3>
                    <p>Email: <?php echo $userDetails['email']; ?></p>
                    <?php if (!empty($userDetails['phone'])): ?>
                        <p>Phone: <?php echo $userDetails['phone']; ?></p>
                    <?php endif; ?>
                </div>
                <?php if (isset($user) && $user['id'] === $product['user_id']): ?>
                    <div class="action">
                        <a href="/edit-product?id=<?php echo $product['id']; ?>" class="btn-action">Edit Product</a>
                        <a href="/delete-product-confirm?id=<?php echo $product['id']; ?>" class="btn-action">Delete Product</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
    <div class="gallery">
        <!-- Gallery -->
        <div class="row">
            <?php if (!empty($imagePaths)): ?>
                    <?php foreach ($imagePaths as $imagePath): ?>
                    <div class="col-lg-3 col-md-4 mb-4 mb-lg-0">
                        <img
                            src="<?php echo $imagePath; ?>"
                            class="w-100 shadow-1-strong rounded mb-4"
                            alt="Product Image"
                        />
                    </div>
                    <?php endforeach; ?>
            <?php else: ?>
                <p>No images available for this product.</p>
            <?php endif; ?>
        </div>
        <!-- Gallery -->
    </div>
</div>
<?php else: ?>
    <p>No product or user found.</p>
<?php endif; ?>