<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
</head>
<body>
<h1>Welcome to the Online Shop</h1>

<?php if (isset($user)): ?>
    <p>Hello, <?php echo $user['name']; ?>!</p>
    <!-- Additional content for logged-in users -->
<?php else: ?>
    <p>Please log in to access the full features of the online shop.</p>
    <!-- Additional content for non-logged-in users -->
<?php endif; ?>
</body>
</html>