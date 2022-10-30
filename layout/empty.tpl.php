<?php
$appParams = getKeyInArray($data, 'appParams', []);
?>

<!doctype html>
<html lang="it">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="<?= getKeyInArray($appParams, 'author', '') ?>">
    <title><?= getKeyInArray($appParams, 'brandName', '') ?> - Home</title>


    <style>
    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
    }

    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
    }
    </style>


    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/files/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/files/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/files/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="/files/favicons/manifest.json">
    <link rel="mask-icon" href="/files/favicons/safari-pinned-tab.svg" color="#7952b3">
    <link rel="icon" href="/files/favicons/favicon.ico">
    <meta name="theme-color" content="#000">





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

    <div class="d-flex align-items-stretch flex-column bg-warning">

        <header>

            <?php include $this->navbar ?>

        </header>

        <div class="d-flex flex-row align-items-stretch">
            <div>
                <?php include $this->sidebar ?>
            </div>

            <div>
                <main>
                    <?= $this->content ?>
                </main>
            </div>
        </div>

    </div>



    <script src="/js/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/2f74d37b46.js" crossorigin="anonymous"></script>
</body>

</html>