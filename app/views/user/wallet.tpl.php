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

                    <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                        data-bs-target="#createMovement" id="--btnCreateMovement">Nuovo movimento</button>
                </div>

                <div class="table-responsive">
                    <table
                        class="mt-2 table table-borderless table-thead-bordered table-nowrap table-align-middle card-table dataTable no-footer p-0">
                        <thead class=" table-secondary">
                            <tr>
                                <th class="col-auto">Data</th>
                                <th class="col text-start">Descrizione</th>
                                <th class="col-1 text-center">Tipologia</th>
                                <th class="col-2 text-end">Importo</th>
                                <th class="col-1"></th>
                            </tr>
                        </thead>
                        <tbody id="--movementsContainer">
                            <!-- import movements -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



    <!-- end of page -->
</div>

<!-- modals della pagina -->
<div>
    <!-- modal nuovo movimento -->
    <div class="modal fade" id="createMovement" tabindex="-1" role="dialog" aria-labelledby="createMovementLabel"
        aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-money-bill"></i> Nuovo
                        Movimento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ">

                    <div class="mx-3">
                        <div class="input-group text-center row">
                            <button type="button" class="btn btn-outline-danger col active"
                                id="--btnEntranceCreateMovement">Entrata</button>
                            <button type="button" class="btn btn-outline-success col"
                                id="--btnExpeseCreateMovement">Spesa</button>
                        </div>
                    </div>

                    <div class="my-3 me-3 row">
                        <label for="--datetimeCreateMovement" class="col-sm-2 col-form-label">Data</label>
                        <div class="col-sm-10">
                            <div class="input-group ">
                                <button class="btn btn-outline-secondary" id="--setToday">oggi</button>
                                <input type="datetime-local" class="form-control" placeholder=""
                                    id="--datetimeCreateMovement">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 me-3 row">
                        <label for="--valueCreateMovement" class="col-sm-2 col-form-label">Importo</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="0" id="--valueCreateMovement">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label class="col-form-label">Categoria</label>
                        </div>
                        <div class="col text-end me-3">
                            <button class="btn btn-link link-secondary text-decoration-none"><i
                                    class="fa-solid fa-plus"></i>
                                Nuova
                                Categoria</button>
                        </div>
                    </div>
                    <div class="border rounded me-4 p-3">


                        <button class="btn btn-link text-decoration-none">
                            <div class="input-group">
                                <div class="btn btn-outline-secondary">categoria</div>
                                <div class="btn btn-secondary">gruppo</div>
                            </div>
                        </button>

                        <button class="btn btn-link text-decoration-none">
                            <div class="input-group">
                                <div class="btn btn-outline-secondary">categoria</div>
                                <div class="btn btn-secondary">gruppo</div>
                            </div>
                        </button>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal"><i
                            class="fa-solid fa-delete-left"></i> Cancella</button>
                    <button type="button" class="btn btn-primary"><i class="fa-solid fa-chevron-right"></i>
                        Inserisci</button>
                    <button type="button" class="btn btn-primary"><i class="fa-solid fa-angles-right"></i>
                        Inserisci e continua</button>

                </div>
            </div>
        </div>
    </div>
    <!-- ENDOF: modal nuovo movimento -->

</div>

<!-- qui c'è il mio script della pagina -->
<script src="/js/custom/app/wallet.js"></script>