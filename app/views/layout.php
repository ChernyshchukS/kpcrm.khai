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
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">Internet Store</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=users">Users</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container mt-4">
        <?php echo $content; ?>
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