<section class="home-section">
    <h1>INDEAVR Online Shop</h1>
    <?php if (!empty($products)): ?>
        <?php foreach ($products as $product): ?>
            <div class="container py-1">
                <div class="row justify-content-center mb-1">
                    <div class="col-md-6 col-xl-6">
                        <div class="card">
                            <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                                <?php $images = json_decode($product['image_path'], true); ?>
                                <?php if (!empty($images)): ?>
                                    <?php $firstImage = $images[0]; ?>
                                <a href="/product-details?id=<?php echo $product['id']; ?>">
                                    <img src="<?php echo '/assets/images/' . $firstImage; ?>" class="w-100" alt="Product Image"/>
                                </a>
                                <?php endif; ?>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $product['name']; ?></h5>
                                <p class="card-text"><?php echo $product['publication_date']; ?></p>
                                <a href="/product-details?id=<?php echo $product['id']; ?>" class="btn btn-primary">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="container py-1">
            <div class="row justify-content-center mb-1">
                <div class="col-md-6 col-xl-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">No products available</h5>
                            <p class="card-text">Start by adding your first product.</p>
                            <?php if (isset($_SESSION['user_id'])): ?>
                                <a href="/create-product" class="btn btn-primary">Add Product</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</section>
