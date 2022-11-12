<div class="container">


    <h3><i class="fa-solid fa-gauge mt-5"></i> Dashboard </h3>

    <div class="row">

        <!-- START BLOCK -->
        <div class="col-md ">
            <a class="card card-hover-shadow h-100 text-decoration-none" href="/wallet">
                <div class="card-body">
                    <h6 class="card-subtitle text-dark">Saldo Attuale</h6>
                    <div class="row">
                        <div class="col-12 text-dark">
                            <h2 id="--currentBalance">{balance}</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="badge bg-success">
                                <i class="fa-solid fa-chart-line"></i> {score}
                            </div>
                        </div>
                        <div class="col-6 text-secondary">
                            <small>
                                Precedente {last_score}</small>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <!-- END BLOCK -->

        <!-- START BLOCK -->
        <div class="col-md mt-3 mt-md-0 ">
            <a class="card card-hover-shadow h-100 text-decoration-none" href="#">
                <div class="card-body">
                    <h6 class="card-subtitle text-dark">{title}</h6>
                    <div class="row">
                        <div class="col-12 text-dark">
                            <h2>{balance}</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="badge bg-success">
                                <i class="fa-solid fa-chart-line"></i> {score}
                            </div>
                        </div>
                        <div class="col-6 text-secondary">
                            <small>
                                Precedente {last_score}</small>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <!-- END BLOCK -->

    </div>

</div>


<!-- qui c'è il mio script della pagina -->
<script src="/js/custom/app/dashboard.js"></script>