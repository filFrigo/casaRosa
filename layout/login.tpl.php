<!doctype html>
<html lang="it">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.104.2">
    <title>Accedi</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/sign-in/">

    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap/bootstrap.min.css" rel="stylesheet">

    <!-- fontawesome core CSS -->
    <link href="/css/fontawesome/css/all.css" rel="stylesheet">


    <!-- Custom styles for this template -->
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


    <script src="/js/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/2f74d37b46.js" crossorigin="anonymous"></script>


    <script src="/js/custom/login/login.js"></script>
</body>

</html>