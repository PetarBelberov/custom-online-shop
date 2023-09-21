<!DOCTYPE html>
    <html>
        <head>
            <title>INDEAVR Online Shop</title>
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
                            </li>
                        <?php endif; ?>
                        <li>
                            <a href="/">Home</a>
                        </li>
                    </ul>
                </nav>
            </header>