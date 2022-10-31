<?php
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

<script src="/js/custom/app/wallet.js"></script>