<!doctype html>
<html lang="ua" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Chernyshchuk S.V., Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title><?= $title ?></title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">

</head>
<body class="d-flex flex-column h-100">
<div class="container">
    <div class="row">
        <div class="sidebar col-md-3">
            <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="min-height: 900px;">
                <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                    <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
                    <span class="fs-4">Internet Store</span>
                </a>
                <hr>
                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item">
                        <a href="/" class="nav-link" aria-current="page">
                            <svg class="bi me-2" width="16" height="16">
                                <use xlink:href="/"></use>
                            </svg>
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="index.php?page=users" class="nav-link text-white">
                            <svg class="bi me-2" width="16" height="16">
                                <use xlink:href="index.php?page=users"></use>
                            </svg>
                            Users
                        </a>
                    </li>
                    <li>
                        <a href="index.php?page=roles" class="nav-link text-white">
                            <svg class="bi me-2" width="16" height="16">
                                <use xlink:href="index.php?page=roles"></use>
                            </svg>
                            Roles
                        </a>
                    </li>
                    <li>
                        <a href="index.php?page=auth&action=register" class="nav-link text-white">
                            <svg class="bi me-2" width="16" height="16">
                                <use xlink:href="index.php?page=auth&action=register"></use>
                            </svg>
                            Register
                        </a>
                    </li>
                    <li>
                        <a href="index.php?page=pages" class="nav-link text-white">
                            <svg class="bi me-2" width="16" height="16">
                                <use xlink:href="index.php?page=pages"></use>
                            </svg>
                            Pages
                        </a>
                    </li>
                </ul>
                <hr>
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                       id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
                        <strong><?=$user_email?></strong>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                        <!-- <li><a class="dropdown-item" href="#">New project...</a></li>
                        <li><a class="dropdown-item" href="#">Settings</a></li> -->
                        <li><a class="dropdown-item" href="/users/profile">Profile</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="index.php?page=auth&action=logout">Sign out</a></li>
                        <li><a class="dropdown-item" href="index.php?page=auth&action=login">Sign in</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="article col-md-9">
            <div class="container mt-4">
                <?php echo $content; ?>
            </div>
        </div>
    </div>
</div>

<!--<div class="container">-->
<!--    <nav class="navbar navbar-expand-lg navbar-light bg-light">-->
<!--        <a class="navbar-brand" href="index.php">Internet Store</a>-->
<!--        <div class="collapse navbar-collapse" id="navbarNav">-->
<!--            <ul class="navbar-nav">-->
<!--                <li class="nav-item">-->
<!--                    <a class="nav-link" href="index.php?page=roles">Roles</a>-->
<!--                </li>-->
<!--                <li class="nav-item">-->
<!--                    <a class="nav-link" href="index.php?page=users">Users</a>-->
<!--                </li>-->
<!--                <li class="nav-item">-->
<!--                    <a class="nav-link" href="index.php?page=auth&action=register">Register</a>-->
<!--                </li>-->
<!--                <li class="nav-item">-->
<!--                    <a class="nav-link" href="index.php?page=auth&action=login">Login</a>-->
<!--                </li>-->
<!--                <li class="nav-item">-->
<!--                    <a class="nav-link" href="index.php?page=auth&action=logout">Logout</a>-->
<!--                </li>-->
<!--            </ul>-->
<!--        </div>-->
<!--    </nav>-->
<!--    <div class="container mt-4">-->
<!--        --><?php //echo $content; ?>
<!--    </div>-->
<!--</div>-->

<footer class="footer mt-auto py-3 bg-light">
    <div class="container text-center">
        <span class="text-muted">студент групи 633п Чернищук С.В.</span>
    </div>
</footer>

<script src="/js/bootstrap.bundle.min.js"></script>

</body>
</html>