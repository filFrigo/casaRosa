<?php
?>
<div class="container">



    <h3><i class="fa-solid fa-hotel mt-5"></i> Impostazioni Zona</h3>

    <div>Una zona è l'insieme di case o appartamenti in gestione all'amministratore condominiale.</div>

    <!-- NOME ZONA -->
    <div class="row g-3 align-items-center  mt-2">
        <div class="col-auto">
            <label for="--zoneName" class="col-form-label">Nome Zona</label>
        </div>
        <div class="col-auto">
            <input type="text" id="--zoneName" class="form-control">
        </div>
        <div class="col-auto">
            <span id="--zoneNameHelp" class="form-text">
                É il nome della zona, usa massimo 128 caratteri.
            </span>
        </div>
    </div>


    <!-- CODICE CLIENTE -->
    <div class="row g-3 align-items-center mt-2">
        <div class="col-auto">
            <label for="--clientID" class="col-form-label">Codice Cliente</label>
        </div>
        <div class="col-auto">
            <input type="text" id="--clientID" class="form-control">
        </div>
        <div class="col-auto">
            <span id="--clientIDHelp" class="form-text">
                É il codice del cliente.
            </span>
        </div>
    </div>

</div>

<script src="/js/custom/config/zone.js"></script>