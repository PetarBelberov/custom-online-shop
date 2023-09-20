<h1>Welcome to the Online Shop</h1>

<?php if (isset($products)): ?>
    <h2>Products</h2>
    <?php foreach ($products as $product): ?>
        <div>
            <h3><?php echo $product['name']; ?></h3>
            <p><?php echo $product['description']; ?></p>
            <!-- Display other product details as needed -->
        </div>
    <?php endforeach; ?>
<?php endif; ?>