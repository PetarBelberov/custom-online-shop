<section class="home-section">
    <?php if (isset($products)): ?>
        <h1>INDEAVR Online Shop</h1>
        <?php foreach ($products as $product): ?>
            <div class="container py-5">
                <div class="row justify-content-center mb-3">
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
    <?php endif; ?>
</section>
