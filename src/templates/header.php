<!DOCTYPE html>
    <html>
        <head>
            <title>INDEAVR Online Shop</title>
            <!-- CSS and other header content here -->
        </head>
        <body>
            <header>
                <nav>
                    <ul>
                        <?php if (isset($user)): ?>
                            <li>
                                <p>Hello, <?php echo $user['name']; ?>!</p>
                            </li>
                        <?php else: ?>
                            <li>
                                <a href="/login">Log In</a>
                                <!-- Additional content for non-logged-in users -->
                            </li>
                        <?php endif; ?>
                        <li>
                            <a href="/">Home</a>
                        </li>
                        <!-- Navigation links as needed -->
                    </ul>
                </nav>
            </header>