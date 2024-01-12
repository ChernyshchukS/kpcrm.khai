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
                <a href="<?= APP_BASE_PATH ?>/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                    <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
                    <span class="fs-4">Internet Store</span>
                </a>
                <hr>
                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item">
                        <a href="<?= APP_BASE_PATH ?>/"
                            <?= is_active(APP_BASE_PATH . '/');?>>
                            <svg class="bi me-2" width="16" height="16">
                                <use xlink:href="<?= APP_BASE_PATH ?>/"></use>
                            </svg>
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="<?= APP_BASE_PATH ?>/pages"
                            <?= is_active(APP_BASE_PATH . '/pages');?>>
                            <svg class="bi me-2" width="16" height="16">
                                <use xlink:href="<?= APP_BASE_PATH ?>/pages"></use>
                            </svg>
                            Pages
                        </a>
                    </li>
                    <li>
                        <a href="<?= APP_BASE_PATH ?>/users"
                            <?= is_active(APP_BASE_PATH . '/users');?>>
                            <svg class="bi me-2" width="16" height="16">
                                <use xlink:href="<?= APP_BASE_PATH ?>/users"></use>
                            </svg>
                            Users
                        </a>
                    </li>
                    <li>
                        <a href="<?= APP_BASE_PATH ?>/roles"
                            <?= is_active(APP_BASE_PATH . '/roles');?>>
                            <svg class="bi me-2" width="16" height="16">
                                <use xlink:href="<?= APP_BASE_PATH ?>/roles"></use>
                            </svg>
                            Roles
                        </a>
                    </li>
                    <li>
                        <a href="<?= APP_BASE_PATH ?>/auth/login"
                            <?= is_active(APP_BASE_PATH . '/auth/login');?>>
                            <svg class="bi me-2" width="16" height="16">
                                <use xlink:href="<?= APP_BASE_PATH ?>/auth/login"></use>
                            </svg>
                            Login
                        </a>
                    </li>
                    <li>
                        <a href="<?= APP_BASE_PATH ?>/auth/register"
                            <?= is_active(APP_BASE_PATH . '/auth/register');?>>
                            <svg class="bi me-2" width="16" height="16">
                                <use xlink:href="<?= APP_BASE_PATH ?>/auth/register"></use>
                            </svg>
                            Register
                        </a>
                    </li>
                    <li>
                        <a href="<?= APP_BASE_PATH ?>/auth/logout"
                            <?= is_active(APP_BASE_PATH . '/auth/logout');?>>
                            <svg class="bi me-2" width="16" height="16">
                                <use xlink:href="<?= APP_BASE_PATH ?>/auth/logout"></use>
                            </svg>
                            Logout
                        </a>
                    </li>
                    <hr>
                    <h4>To do list</h4>
                    <li>
                        <a href="<?= APP_BASE_PATH ?>/todo/categories"
                            <?= is_active(APP_BASE_PATH . '/todo/categories');?>>
                            <svg class="bi me-2" width="16" height="16">
                                <use xlink:href="<?= APP_BASE_PATH ?>/todo/categories"></use>
                            </svg>
                            Categories
                        </a>
                    </li>
                </ul>
                <hr>
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                       id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
<!--                        <strong>--><?php //=$user_email?><!--</strong>-->
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                        <!-- <li><a class="dropdown-item" href="#">New project...</a></li>
                        <li><a class="dropdown-item" href="#">Settings</a></li> -->
                        <li><a class="dropdown-item" href="<?= APP_BASE_PATH ?>/users/profile">Profile</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="<?= APP_BASE_PATH ?>/auth/logout">Sign out</a></li>
                        <li><a class="dropdown-item" href="<?= APP_BASE_PATH ?>/auth/login">Sign in</a></li>
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

<footer class="footer mt-auto py-3 bg-light">
    <div class="container text-center">
        <span class="text-muted">студент групи 633п Чернищук С.В.</span>
    </div>
</footer>

<script src="/js/bootstrap.bundle.min.js"></script>

</body>
</html>