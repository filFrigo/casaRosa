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
    <!-- <link href="/css/bootstrap/bootstrap.min.css" rel="stylesheet"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">


    <!-- fontawesome core CSS -->
    <!-- <link href="/css/fontawesome/css/all.css" rel="stylesheet"> -->

    <!-- costum style -->
    <link href="/css/custom/class.css" rel="stylesheet">
    <!-- Style for carosel -->
    <!-- <link href="/css/custom/carousel.css" rel="stylesheet"> -->
    <!-- Style for timeline -->
    <!-- <link href="/css/falcon/timeline.css" rel="stylesheet"> -->
</head>

<body class="m-0 p-0">


    <?php $this->navbar ? include $this->navbar : '' ?>

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


    <!-- fontAwesome -->
    <script src="https://kit.fontawesome.com/2f74d37b46.js" crossorigin="anonymous"></script>

    <!--  BOOTSTRAP -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>


    <!-- myscript -->
    <script src="/js/custom/functions.js"></script>

</body>

</html>