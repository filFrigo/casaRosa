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
$movements = [
    [
        'data' => '12/9',
        'descrizione' => 'bolletta luce',
        'tipologia' => 'spesa',
        'color' => 'danger',
        'importo' => -100,
    ],
    [
        'data' => '12/9',
        'descrizione' => 'bolletta acqua',
        'tipologia' => 'spesa',
        'color' => 'danger',

        'importo' => -100,
    ],
    [
        'data' => '12/9',
        'descrizione' => 'spese giardino',
        'tipologia' => 'spesa',
        'color' => 'danger',

        'importo' => -100,
    ],
    [
        'data' => '12/9',
        'descrizione' => 'versamento Pippo',
        'tipologia' => 'entrata',
        'color' => 'success',

        'importo' => 300,
    ],
];
?>


<div class="container">

    <h1>Casa Rosa</h1>

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


    <h3><i class="fa-solid fa-wallet mt-5"></i> Situazione</h3>

    <div class="row">


        <div class="col-12 card card-hover-shadow h-100 px-0">
            <div class="card-body px-0">

                <div class="text-end w-100 px-3">

                    <button class="btn btn-primary" type="button">Nuovo movimento</button>
                </div>


                <table
                    class="mt-2 table table-borderless table-thead-bordered table-nowrap table-align-middle card-table dataTable no-footer p-0">
                    <thead class=" table-secondary">
                        <tr>
                            <th>Data</th>
                            <th>Descrizione</th>
                            <th>Tipologia</th>
                            <th>Importo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($movements as $mov) :  ?>
                        <tr>
                            <td>
                                <?= $mov['data'] ?>
                            </td>
                            <td>
                                <?= $mov['descrizione'] ?>
                            </td>
                            <td>
                                <div class="badge bg-<?= $mov['color'] ?>">
                                    <?= $mov['tipologia'] ?>
                                </div>
                            </td>
                            <td>
                                <?= $mov['importo'] ?> €
                            </td>
                        </tr>
                        <?php endforeach;    ?>
                    </tbody>
                </table>
            </div>


        </div>



    </div>


</div>