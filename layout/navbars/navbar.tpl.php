<?php

// var_dump($data);

$brand = getKeyInArray($data['appParams'], 'brandName', '')
?>


<!-- NAVBAR -->
<header class="navbar navbar-dark sticky-top flex-md-nowrap p-0 shadow">
    <div class="d-flex flex-wrap justify-content-center py-0 m-0 border-bottom flex-column flex-md-row
 w-100 bg-light">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
            <span class="fs-4 ms-3"><?= $brand ?></span>
        </a>

        <div class="d-flex flex-row-reverse align-items-center">
            <!-- <li class="nav-item"><a href="/dashboard" class="nav-link" aria-current="page">Dashboard</a></li> -->

            <!-- configurazioni -->
            <div>
                <button class="nav-link btn btn-link" data-bs-toggle="offcanvas" data-bs-target="#configMenu">
                    <i class="fa-solid fa-gear h4 link-dark"></i>
            </div>

            <!-- cambio istanza -->
            <div>
                <button class="btn btn-link link-dark text-decoration-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#leftMenu" aria-controls="offcanvasExample" id="--btnAreas">
                    <div class="d-flex flex-row align-items-center ">

                        <div class="d-flex align-items-center me-2">
                            <i class="fa-solid fa-hotel h4 text-dark"></i>
                        </div>
                        <div>
                            <div>
                                <?= sessionData('zone_name') ?? '{zone_name}' ?>
                            </div>
                            <div>
                                <?= sessionData('email') ?? '{user_email}' ?>
                            </div>
                        </div>
                    </div>
                </button>
            </div>

            <!-- licenza -->
            <div>
                <button class="nav-link btn btn-link">
                    <i class="fa-regular fa-id-badge h4 link-dark"></i>
                </button>
            </div>

            <!-- supporto -->
            <div>
                <button class="nav-link btn btn-link">
                    <i class="fa-solid fa-headset h4 link-dark"></i> </button>
            </div>

            <!-- news -->
            <div>
                <button class="nav-link btn btn-link">
                    <i class="fa-regular fa-newspaper h4 link-dark"></i>
            </div>
        </div>

    </div>
</header>


<!-- OFFCANVAS -->
<span class="--navbarOffCavas">

    <!-- modal zones -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="leftMenu"">
            <div class=" offcanvas-header">
        <div class="offcanvas-title" id="leftMenuLabel">
            <h5><?= sessionData('zone_name') ?? '{zone_name}' ?>
                [<?= sessionData('zone_clientid') ?? '{zone_clientid}' ?>]
            </h5>
            <div><?= sessionData('email') ?? '{user_email}' ?></div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <!-- search bar -->
        <div class="form-group">
            <div class="col-xs-5">
                <div class="input-group">
                    <div class="input-group-addon border-0 d-flex align-items-center">
                        <i class=" h6 fa-solid fa-magnifying-glass"></i>

                    </div>
                    <input class="form-control  border-0" placeholder="cerca struttura.." type="search" id="--searchAreas">
                </div>
            </div>
        </div>
        <!-- elenco strutture -->
        <div class="border rounded m-2 w-80 " style="height: 25em;overflow-y: scroll;" id="--areasLists">
            <!-- qui inseriamo l'elenco delle strutture -->
        </div>

        <!-- tasti veloci d'azione -->
        <div>
            <button class="btn btn-link"><i class="fa-solid fa-gear"></i> Gestione</button>
        </div>
        <div>
            <button class="btn btn-link" id="--btnLogout"><i class="fa-solid fa-arrow-right-from-bracket"></i>
                Disconnetti</button>
        </div>
    </div>
    </div>



    <!-- MODAL MENU -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="configMenu" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <div class="offcanvas-title" id="leftMenuLabel">
                <h5>Configurazioni</h5>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <h7 class="text-secondary">Impostazioni Base</h7>
            <div>
                <a href="/config/zone" class="btn btn-link text-decoration-none"><i class="fa-solid fa-hotel"></i>
                    Impostazioni Zona</a>
            </div>
            <div>
                <a href="/config/areas" class="btn btn-link text-decoration-none"><i class="fa-solid fa-people-roof"></i>
                    Suddivisione Aree</a>
            </div>

            <div>
                <a href="/config/users" class="btn btn-link text-decoration-none"><i class="fa-solid fa-users"></i>
                    Utenti</a>
            </div>
        </div>
    </div>


    <!-- ENDOF: OFFCANVAS -->
</span>


<script src="/js/custom/navbar.js"></script>