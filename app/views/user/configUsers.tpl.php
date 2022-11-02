<div class="container">

    <h3><i class="fa-solid fa-users mt-5"></i> Lista Utenti</h3>
    <div>Gli utenti, sono le persone che vivono all'interno delle aree gestite. </div>

    <div class="row">
        <div class="col-12 card card-hover-shadow h-100 px-0">
            <div class="card-body px-0">

                <div class="text-end w-100 px-3">

                    <button class="btn btn-primary" type="button">Nuovo utente</button>
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

<script src="/js/custom/config/users.js"></script>