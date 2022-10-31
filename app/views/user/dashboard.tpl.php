<?php

$dashboardData = [
    [
        'title' => 'Saldo Attuale',
        'balance' => '1900 €',
        'scoreBalance' => '50 %',
        'prevBalance' => 50
    ],
    [
        'title' => 'Movimenti',
        'balance' => '+ 100 €',

        'scoreBalance' => '100 %',
        'prevBalance' => 50
    ],
    [
        'title' => 'Condomini',
        'balance' => 13,

        'scoreBalance' => '0 %',
        'prevBalance' => 13
    ],
    [
        'title' => 'Altro..',
        'balance' => 0,

        'scoreBalance' => '0 %',
        'prevBalance' => 0
    ],
];

?>


<div class="container">



    <h3><i class="fa-solid fa-gauge mt-5"></i> Dashboard </h3>

    <div class="row">

        <?php foreach ($dashboardData as $data) :    ?>
            <div class="col-md-3 ">

                <a class="card card-hover-shadow h-100 text-decoration-none" href="#">
                    <div class="card-body">
                        <h6 class="card-subtitle text-dark"><?= $data['title'] ?></h6>
                        <div class="row">
                            <div class="col-12 text-dark">
                                <h2><?= $data['balance'] ?></h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="badge bg-success">
                                    <i class="fa-solid fa-chart-line"></i> <?= $data['scoreBalance'] ?>
                                </div>
                            </div>
                            <div class="col-6 text-secondary">
                                <small>
                                    Precedente <?= $data['prevBalance'] ?>
                                </small>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach;    ?>

    </div>





</div>