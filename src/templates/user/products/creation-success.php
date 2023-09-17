<?php
// Check if the productCreated session variable is set to true
if (isset($_SESSION['productCreated']) && $_SESSION['productCreated']) :
    // Clear the productCreated session variable
    $_SESSION['productCreated'] = false;
?>
<div id="success-message">
    <h1>Product Creation Success</h1>
    <p>Your product has been created successfully.</p>
    <a href="/">View All Products</a>
</div>
<?php else :
    // Redirect to the success page.
    header('Location: /404');
    exit;
?>
<?php endif; ?>
