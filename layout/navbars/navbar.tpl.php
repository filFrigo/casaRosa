<?php

// var_dump($data);

$brand = getKeyInArray($data['appParams'], 'brandName', '')
?>


<!-- barra superiore -->
<div class="d-flex flex-wrap justify-content-center py-0 m-0 border-bottom flex-column flex-md-row ">
    <a href="/" class=" d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
        <span class="fs-4"><?= $brand ?></span>
    </a>

    <div class="d-flex flex-row-reverse align-items-center">
        <!-- <li class="nav-item"><a href="/dashboard" class="nav-link" aria-current="page">Dashboard</a></li> -->



        <!-- cambio istanza -->
        <div>
            <button class="btn btn-link" type="button" data-bs-toggle="offcanvas" data-bs-target="#leftMenu"
                aria-controls="offcanvasExample">
                <div class="d-flex flex-row align-items-center text-decoration-none">

                    <div class="d-flex align-items-center me-2">
                        <i class="fa-solid fa-hotel h4 link-dark"></i>
                    </div>
                    <div class="">
                        <div class="text-decoration-none link-dark">
                            {nome_azienda}
                        </div>
                        <div class="text-decoration-none link-dark">
                            {email_login_operatore}
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

    <div class="offcanvas offcanvas-end" tabindex="-1" id="leftMenu" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <div class="offcanvas-title" id="leftMenuLabel">
                <h5><?= $brand ?></h5>
                <div>{user_login_email}</div>

            </div>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">

            <!-- search bar -->
            <form>
                <div class="form-group">
                    <div class="col-xs-5">
                        <div class="input-group">
                            <div class="input-group-addon border-0 d-flex align-items-center">
                                <i class=" h6 fa-solid fa-magnifying-glass"></i>

                            </div>
                            <input class="form-control  border-0" placeholder="cerca struttura.." type="search">
                        </div>
                    </div>
                </div>
            </form>





            <!-- elenco strutture -->
            <div class="border rounded m-2 w-80 mh-100">
                <div>test1</div>
                <div>test2</div>
            </div>

            <!-- tasti veloci d'azione -->
            <div>
                <button class="btn btn-link"><i class="fa-solid fa-gear"></i> Gestione</button>
            </div>
            <div>
                <button class="btn btn-link"><i class="fa-solid fa-arrow-right-from-bracket"></i> Disconnetti</button>
            </div>
        </div>
    </div>
</div>