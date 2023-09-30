<!DOCTYPE html>
    <html>
        <head>
            <title>v</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
            <link href="assets/css/style.css" rel="stylesheet" />
        </head>
        <body>
            <header>
<!--                <nav>-->
<!--                    <ul>-->
<!--                        --><?php //if (isset($user)): ?>
<!--                            <li>-->
<!--                                <p>Hello, --><?php //echo $user['name']; ?><!--!</p>-->
<!--                            </li>-->
<!--                            <li>-->
<!--                                <a href="/logout">Logout</a>-->
<!--                            </li>-->
<!--                        --><?php //else: ?>
<!--                            --><?php //if (!isset($hideLoginOption)): ?>
<!--                                <li>-->
<!--                                    <a href="/login">Log In</a>-->
<!--                                </li>-->
<!--                            --><?php //endif; ?>
<!--                        --><?php //endif; ?>
<!--                        <li>-->
<!--                            <a href="/">Home</a>-->
<!--                        </li>-->
<!--                    </ul>-->
<!--                </nav>-->

                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <?php if (isset($user)): ?>
                                    <li class="nav-item">
                                        <span class="nav-link"><?php echo $user['name'] . "'s profile" ?></span>
                                    </li>
                                <?php endif; ?>
                                <li>
                                    <a class="nav-link active" aria-current="page" href="/">Home</a>
                                </li>
                            </ul>
                            <ul class="navbar-nav d-flex flex-row me-1">
                                <?php if (isset($user)): ?>
                                    <li class="nav-item">
                                        <a class="nav-link" aria-current="page" href="/logout">Logout</a>
                                    </li>
                                <?php else: ?>
                                    <?php if (!isset($hideLoginOption)): ?>
                                        <li class="nav-item">
                                            <a class="nav-link" aria-current="page" href="/login">Log In</a>
                                        </li>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </nav>
            </header>