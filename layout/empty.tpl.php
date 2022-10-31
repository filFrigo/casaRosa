<?php
$appParams = getKeyInArray($data, 'appParams', []);
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="<?= getKeyInArray($appParams, 'author', '') ?>">
    <title><?= getKeyInArray($appParams, 'brandName', '') ?> - Home</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/dashboard/">




    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap/bootstrap.min.css" rel="stylesheet">

    <!-- fontawesome core CSS -->
    <link href="/css/fontawesome/css/all.css" rel="stylesheet">


    <script type="text/javascript"></script>

    <!-- Style for carosel -->
    <link href="/css/custom/carousel.css" rel="stylesheet">
    <!-- Style for timeline -->
    <link href="/css/falcon/timeline.css" rel="stylesheet">
</head>

<body class="m-0 p-0">

    <header class="navbar navbar-dark sticky-top flex-md-nowrap p-0 shadow">
        <?php $this->navbar ? include $this->navbar : '' ?>
    </header>

    <div class="container-fluid">
        <div class="row">
            <nav class="col-auto m-0 p-0 sidebar">
                <div class="position-sticky sidebar-sticky">

                    <?php $this->sidebar ? include $this->sidebar : '' ?>

                </div>
            </nav>

            <main class="col m-0 p-0">
                <?= $this->content ?>
            </main>
        </div>
    </div>

    <!--  script -->
    <script src="/js/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/2f74d37b46.js" crossorigin="anonymous"></script>
</body>

</html>