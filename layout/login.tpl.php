<!doctype html>
<html lang="it">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.104.2">
    <title>Accedi</title>

    <!-- Bootstrap core CSS -->
    <!-- <link href="/css/bootstrap/bootstrap.min.css" rel="stylesheet"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <!-- CUSTOM STYLE -->
    <link href="/css/custom/signin.css" rel="stylesheet">
</head>

<body class="text-center">

    <main class="form-signin w-100 m-auto">
        <form>
            <img class="mb-4 d-none" src="/assets/brand/logo.svg" alt="" width="72" height="57">
            <h1 class="h3 mb-3 fw-normal">Accedi</h1>

            <div class="form-floating">
                <input type="email" class="form-control" placeholder="name@example.com" id="--email">
                <label for="--email">Indirizzo Email</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" placeholder="Password" id="--password">
                <label for="--password">Password</label>
            </div>

            <button class="w-100 btn btn-lg btn-primary" type="submit" id="--btnLogin">Accedi</button>

            <div id="--outputMessage" class="alert alert-danger my-3 d-none">test</div>

            <p class="mt-5 mb-3 text-muted">&copy; 2022–2022</p>
        </form>
    </main>


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
    <script src="/js/custom/login/login.js"></script>
</body>

</html>