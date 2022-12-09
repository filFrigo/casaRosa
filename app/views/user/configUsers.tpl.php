<div class="container">

    <h3><i class="fa-solid fa-users mt-5"></i> Lista Utenti</h3>
    <div>Gli utenti, sono le persone che vivono all'interno delle aree gestite. </div>

    <div class="row">
        <div class="col-12 card card-hover-shadow h-100 px-0">
            <div class="card-body px-0">

                <div class="text-end w-100 px-3">

                    <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#createUsers" id="--btnCreateUsers">Nuovo</button>
                </div>

                <table class="mt-2 table table-borderless table-thead-bordered table-nowrap table-align-middle card-table dataTable no-footer p-0">

                    <!-- Intestazione -->
                    <thead class=" table-secondary">
                        <tr>
                            <th>Nome</th>
                            <th>Cognome</th>
                            <th>Email</th>
                            <th></th>
                        </tr>
                    </thead>

                    <!-- elenco delle zone -->
                    <tbody id="--usersContainer">
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>

<!-- end of page -->


<!-- modals della pagina -->
<div>
    <!-- modal nuovo movimento -->
    <div class="modal fade" id="createUsers" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-user"></i> Nuovo
                        Utente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ">

                    <div class="mb-3 me-3 row">
                        <label for="--userName" class="col-sm-2 col-form-label">Nome</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="nome" id="--userName">
                        </div>
                    </div>

                    <div class="mb-3 me-3 row">
                        <label for="--userSurname" class="col-sm-2 col-form-label">Cognome</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="cognome" id="--userSurname">
                        </div>
                    </div>

                    <div class="mb-3 me-3 row">
                        <label for="--userEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" placeholder="email" id="--userEmail">
                        </div>
                    </div>

                    <!-- Questo è un messaggio in caso di errori -->
                    <div class="my-3 me-4 alert d-none" id="--alertCreateMovement">Questo è un errore!
                    </div>


                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-outline-warning" data-dismiss="modal" id="--btnResetbtnCreateUsers"><i class="fa-solid fa-delete-left"></i> Reset</button>
                    <button type="button" class="btn btn-primary" id="--btnSaveUsers"><i class="fa-solid fa-chevron-right"></i>
                        Inserisci</button>
                </div>
            </div>
        </div>
    </div>


    <!-- STOP modals della pagina -->
</div>

<script src="/js/custom/config/users.js"></script>